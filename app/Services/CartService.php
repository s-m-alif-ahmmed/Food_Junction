<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get or create the active cart for the current user/session.
     */
    public function getCart(): Cart
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()]
            );

            // If user logged in and has session cart, we might merge them later.
            // For now, let's keep it simple.
            return $cart;
        }

        $sessionId = Session::getId();
        return Cart::firstOrCreate(
            ['session_id' => $sessionId, 'user_id' => null]
        );
    }

    /**
     * Add an item to the cart.
     */
    public function addItem($productId, $weight = null, $quantity = null)
    {
        $product = Product::find($productId);
        if (!$product) {
            throw new \Exception('Product not found.');
        }

        $cart = $this->getCart();
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        $price = $product->discount_price ?? $product->price;

        if ($cartItem) {
            if ($product->product_type === 'Sweet') {
                $cartItem->unit_value += $weight;
            } elseif ($product->product_type === 'Product') {
                $cartItem->quantity += $quantity;
            }
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'unit_type' => $product->product_type === 'Sweet' ? 'kg' : 'pcs', // Using kg/gm logic context
                'unit_value' => $product->product_type === 'Sweet' ? $weight : 0, // for sweets, weight is stored here
                'quantity' => $product->product_type === 'Product' ? $quantity : 1, // for sweets, qty is 1, weight varies
                'unit_price' => $price,
            ]);
        }

        $this->calculateTotals($cart);

        return $cart;
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItem($productId)
    {
        $cart = $this->getCart();
        CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->delete();

        $this->calculateTotals($cart);

        return $cart;
    }

    /**
     * Apply a coupon to the cart.
     */
    public function applyCoupon($code)
    {
        $coupon = Coupon::where('code', $code)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->first();

        if (!$coupon) {
            throw new \Exception('Invalid or expired coupon code.');
        }

        $cart = $this->getCart();
        $cart->coupon_code = $coupon->code;
        $cart->save();

        $this->calculateTotals($cart);

        return $coupon;
    }

    /**
     * Remove the coupon from the cart.
     */
    public function removeCoupon()
    {
        $cart = $this->getCart();
        $cart->coupon_code = null;
        $cart->save();

        $this->calculateTotals($cart);
    }

    /**
     * Calculate and save all totals for the cart.
     */
    public function calculateTotals(Cart $cart)
    {
        $items = $cart->items()->with('product')->get();

        $subTotal = 0;
        $totalSweetWeight = 0; // in grams

        // Calculate line totals
        foreach ($items as $item) {
            $product = $item->product;
            if (!$product) continue;

            $price = $product->discount_price ?? $product->price;

            if ($product->product_type === 'Sweet') {
                $gmPrice = $price / 1000;
                $weight = $item->unit_value; // Assuming unit_value holds the weight in grams as per previous logic
                $lineTotal = $gmPrice * $weight;
                $subTotal += $lineTotal;
                $totalSweetWeight += $weight;
            } elseif ($product->product_type === 'Product') {
                $lineTotal = $item->quantity * $price;
                $subTotal += $lineTotal;
            } else {
                $lineTotal = 0;
            }

            // Update item total price
            $item->total_price = $lineTotal;
            $item->unit_price = $price;
            $item->save();
        }

        $offerDiscount = 0;
        $couponDiscount = 0;
        $deliveryFee = 60; // Base delivery fee

        // ==========================================
        // 1. LEGACY HARDCODED LOGIC (Isolated for easy removal)
        // ==========================================
        if ($cart->user_id) { // Equivalent to Auth::check()
            $offerDiscount += $subTotal * 0.05; // 5% login discount
        }

        $legacyFreeDelivery = false;
        if ($totalSweetWeight > 2000) {
            $legacyFreeDelivery = true; // Free delivery for >2kg sweets
        }

        if ($legacyFreeDelivery) {
            $deliveryFee = 0;
        }
        // ==========================================
        // END LEGACY HARDCODED LOGIC
        // ==========================================


        // ==========================================
        // 2. NEW DYNAMIC OFFER ENGINE LOGIC
        // ==========================================
        $activeOffers = Offer::where('is_active', true)
            ->where('coupon_enabled', false)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->orderBy('priority', 'desc')
            ->get();

        foreach ($activeOffers as $offer) {
            // Check location scope
            if ($offer->location_scope !== 'all') {
                if ($cart->delivery_zone && $cart->delivery_zone !== $offer->location_scope) {
                    continue; // skip if delivery zone doesn't match
                }
            }

            if ($offer->offer_type === 'free_delivery') {
                $deliveryFee = 0;
                // Currently free delivery applies to entire cart, could add conditions later
            } elseif ($offer->offer_type === 'discount') {
                if ($offer->applies_to === 'cart') {
                    if ($offer->discount_type === 'percent') {
                        $offerDiscount += ($subTotal * $offer->discount_value) / 100;
                    } elseif ($offer->discount_type === 'fixed') {
                        $offerDiscount += $offer->discount_value;
                    }
                } elseif ($offer->applies_to === 'product') {
                    $applicableProductIds = $offer->products()->pluck('products.id')->toArray();
                    $applicableSubtotal = 0;
                    foreach ($items as $item) {
                        if (in_array($item->product_id, $applicableProductIds)) {
                            $applicableSubtotal += $item->total_price;
                        }
                    }

                    if ($applicableSubtotal > 0) {
                        if ($offer->discount_type === 'percent') {
                            $offerDiscount += ($applicableSubtotal * $offer->discount_value) / 100;
                        } elseif ($offer->discount_type === 'fixed') {
                            // Apply fixed discount max up to the applicable subtotal
                            $offerDiscount += min($offer->discount_value, $applicableSubtotal);
                        }
                    }
                }
            }
        }
        // ==========================================
        // END NEW DYNAMIC OFFER ENGINE LOGIC
        // ==========================================


        // ==========================================
        // 3. COUPON ENGINE LOGIC
        // ==========================================
        if ($cart->coupon_code) {
            $coupon = Coupon::where('code', $cart->coupon_code)->first();
            if ($coupon) {
                // Determine base for coupon (subtotal after other discounts or raw subtotal? Usually raw subtotal)
                // For safety, don't let total discount exceed subtotal.
                if ($coupon->type === 'percent') {
                    $couponDiscount = ($subTotal * $coupon->discount_amount) / 100;
                } elseif ($coupon->type === 'fixed') {
                    $couponDiscount = $coupon->discount_amount;
                }
            }
        }
        // ==========================================
        // END COUPON ENGINE LOGIC
        // ==========================================

        $totalDiscount = $offerDiscount + $couponDiscount;

        // Ensure discount doesn't exceed subtotal
        if ($totalDiscount > $subTotal) {
            $totalDiscount = $subTotal;
        }

        $total = ($subTotal - $totalDiscount) + $deliveryFee;

        // Save totals to cart
        $cart->subtotal = round($subTotal, 2);
        $cart->discount = round($totalDiscount, 2);
        $cart->offer_discount = round($offerDiscount, 2);
        $cart->coupon_discount = round($couponDiscount, 2);
        $cart->delivery_fee = round($deliveryFee, 2);
        $cart->total = round($total, 2);
        $cart->save();
    }

    /**
     * Clear the cart (e.g. after successful order).
     */
    public function clearCart()
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        $cart->delete();
    }
}
