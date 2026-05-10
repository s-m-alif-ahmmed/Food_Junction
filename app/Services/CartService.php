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
    public function addItem($productId, $weight = null, $quantity = null, $variantId = null)
    {
        $product = Product::find($productId);
        if (!$product) {
            throw new \Exception('Product not found.');
        }

        if (!$variantId && $product->variants()->count() > 0) {
            $variantId = $product->variants()->first()->id;
        }

        $cart = $this->getCart();
        
        // Find existing item with same variant
        $query = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId);
            
        if ($variantId) {
            $query->where('variant_id', $variantId);
        } else {
            $query->whereNull('variant_id');
        }
        
        $cartItem = $query->first();

        // Determine Price
        $price = $product->discount_price ?? $product->price;
        $variantName = null;
        $unit = null;
        $variantQuantity = null;

        if ($variantId) {
            $variant = \App\Models\ProductVariant::find($variantId);
            if ($variant) {
                $price = $variant->sale_price ?? $variant->price;
                $variantName = $variant->variant_type ?? ($variant->quantity . ' ' . $variant->unit);
                $unit = $variant->unit;
                $variantQuantity = $variant->quantity;
            }
        }

        if ($cartItem) {
            $cartItem->quantity += ($quantity ?? 1);
            $cartItem->unit_price = $price;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'item_type' => 'product',
                'quantity' => $quantity ?? 1,
                'variant_name' => $variantName,
                'unit' => $unit,
                'variant_quantity' => $variantQuantity,
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
        // 1. Find coupon by code (ignore status for now so we can give specific errors)
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            throw new \Exception('Coupon code not found. Please check and try again.');
        }

        // 2. Status check
        if ($coupon->status !== 'active') {
            throw new \Exception('This coupon is not active.');
        }

        // 3. Start date check
        if ($coupon->starts_at && now()->lt($coupon->starts_at)) {
            throw new \Exception('This coupon is not valid yet. It starts on ' . \Carbon\Carbon::parse($coupon->starts_at)->format('M d, Y') . '.');
        }

        // 4. Expiry date check
        if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
            throw new \Exception('This coupon has expired.');
        }

        // 5. Minimum order amount check
        $cart = $this->getCart();
        $this->calculateTotals($cart);
        $cart->refresh();

        if ($coupon->min_amount && $cart->subtotal < $coupon->min_amount) {
            throw new \Exception('Minimum order amount of Tk ' . number_format($coupon->min_amount, 2) . ' is required to use this coupon. Your subtotal is Tk ' . number_format($cart->subtotal, 2) . '.');
        }

        // 6. Global usage limit check
        if ($coupon->max_uses) {
            $usedCount = \App\Models\Order::where('coupon_code', $coupon->code)
                ->whereIn('status', ['pending', 'complete'])
                ->count();
            if ($usedCount >= $coupon->max_uses) {
                throw new \Exception('This coupon has reached its maximum usage limit.');
            }
        }

        // 7. Per-user usage limit check
        if ($coupon->max_uses_user && \Illuminate\Support\Facades\Auth::check()) {
            $userId = \Illuminate\Support\Facades\Auth::id();
            $userUsedCount = \App\Models\Order::where('coupon_code', $coupon->code)
                ->where('user_id', $userId)
                ->whereIn('status', ['pending', 'complete'])
                ->count();
            if ($userUsedCount >= $coupon->max_uses_user) {
                throw new \Exception('You have already used this coupon the maximum number of times.');
            }
        }

        // 8. Check if any cart product is under an active offer that blocks coupons
        $cartProductIds = $cart->items()->pluck('product_id')->toArray();

        if (!empty($cartProductIds)) {
            // Find all active offers where coupon_enabled = false and applies_to = 'product'
            $blockingOffers = Offer::active()
                ->where('coupon_enabled', false)
                ->where('applies_to', 'product')
                ->with('conditions')
                ->get();

            foreach ($blockingOffers as $offer) {
                // Get product IDs this offer is restricted to
                $offerProductIds = $offer->conditions()
                    ->where('condition_type', 'product_id')
                    ->pluck('value')
                    ->map(fn($v) => (int) $v)
                    ->toArray();

                // Check if any cart product overlaps with this offer's products
                $blockedProducts = array_intersect($cartProductIds, $offerProductIds);
                if (!empty($blockedProducts)) {
                    throw new \Exception('One or more products in your cart are part of a special offer that does not allow coupon codes.');
                }
            }

            // Also check cart-wide offers with coupon_enabled = false
            $blockingCartOffers = Offer::active()
                ->where('coupon_enabled', false)
                ->where('applies_to', 'cart')
                ->get();

            if ($blockingCartOffers->isNotEmpty()) {
                throw new \Exception('An active offer on your cart does not allow coupon codes to be applied.');
            }
        }

        // All checks passed — apply coupon

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
     * Set delivery zone (dhaka / outside) and recalculate totals.
     */
    public function setDeliveryZone(string $zone): Cart
    {
        $allowed = ['inside_dhaka', 'outside_dhaka'];
        if (!in_array($zone, $allowed)) {
            throw new \Exception('Invalid delivery zone selected.');
        }

        $cart = $this->getCart();
        $cart->delivery_zone = $zone;
        $cart->save();

        $this->calculateTotals($cart);
        $cart->refresh();

        return $cart;
    }

    /**
     * Calculate and save all totals for the cart.
     */
    public function calculateTotals(Cart $cart)
    {
        $items = $cart->items()->with('product')->get();

        $subTotal = 0;
        $totalSweetWeight = 0; // in grams
        $offerDiscount = 0;

        // Zone-aware base delivery fee
        $zone = $cart->delivery_zone;
        $deliveryFee = match($zone) {
            'outside_dhaka' => 120,
            'inside_dhaka'  => 60,
            default         => 60,
        };

        // Calculate line totals
        foreach ($items as $item) {
            $product = $item->product;
            if (!$product) continue;

            // Use stored unit_price (which is set in addItem based on variants)
            $price = $item->unit_price;

            if ($item->variant_id) {
                // If it's a variant, we treat it as quantity based usually (e.g. 1 x 1kg variant)
                $lineTotal = $item->quantity * $price;
                $subTotal += $lineTotal;
            } elseif ($product->product_type === 'Sweet') {
                if ($item->unit_value > 0) {
                    $gmPrice = $price / 1000;
                    $weight = $item->unit_value;
                    $lineTotal = $gmPrice * $weight;
                    $subTotal += $lineTotal;
                    $totalSweetWeight += $weight;
                } else {
                    $lineTotal = $item->quantity * $price;
                    $subTotal += $lineTotal;
                }
            } elseif ($product->product_type === 'Product') {
                $lineTotal = $item->quantity * $price;
                $subTotal += $lineTotal;
            } else {
                $lineTotal = $item->quantity * $price;
                $subTotal += $lineTotal;
            }

            // Update item total price
            $item->subtotal = $lineTotal;
            $item->total = $lineTotal;
            $item->save();

            // ==========================================
            // NEW: Product-Specific Location Conditions
            // ==========================================
            if ($product->location_conditions) {
                foreach ($product->location_conditions as $cond) {
                    if ($cond['scope'] == 'all' || ($cart->delivery_zone && $cond['scope'] == $cart->delivery_zone)) {
                        if (!empty($cond['discount'])) {
                            // Apply discount per item quantity
                            $offerDiscount += ($cond['discount'] * $item->quantity);
                        }
                        if ($cond['free_delivery']) {
                            $deliveryFee = 0;
                        }
                    }
                }
            }
        }

        $couponDiscount = 0;

        // ==========================================
        // 1. LEGACY HARDCODED LOGIC (Isolated for easy removal)
        // ==========================================
//        if ($cart->user_id) { // Equivalent to Auth::check()
//            $offerDiscount += $subTotal * 0.05; // 5% login discount
//        }

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
        // 2. ADVANCED DYNAMIC OFFER ENGINE LOGIC
        // ==========================================
        $activeOffers = Offer::active()
            ->with(['conditions', 'rewards'])
            ->orderBy('priority', 'desc')
            ->get();

        foreach ($activeOffers as $offer) {
            // Check location scope at offer level
            if ($offer->location_scope !== 'all') {
                $mappedZone = match($cart->delivery_zone) {
                    'inside_dhaka' => 'dhaka',
                    'outside_dhaka' => 'outside',
                    default => null,
                };
                if ($mappedZone !== $offer->location_scope) {
                    continue;
                }
            }

            // Check conditions
            $metConditions = true;
            foreach ($offer->conditions as $condition) {
                if (!$this->checkOfferCondition($condition, $cart, $items, $subTotal)) {
                    $metConditions = false;
                    break;
                }
            }

            if (!$metConditions) continue;

            // Apply Rewards
            foreach ($offer->rewards as $reward) {
                switch ($reward->reward_type) {
                    case 'free_delivery_inside_dhaka':
                        if ($cart->delivery_zone === 'inside_dhaka') {
                            $deliveryFee = 0;
                        }
                        break;
                    case 'free_delivery_country':
                        $deliveryFee = 0;
                        break;
                    case 'discount_percent':
                        $offerDiscount += ($subTotal * $reward->discount_value) / 100;
                        break;
                    case 'discount_amount':
                        $offerDiscount += $reward->discount_value;
                        break;
                    // Add other reward types as needed
                }
            }

            // Handle legacy offer_type if rewards are empty (for backward compatibility if needed)
            if ($offer->rewards->isEmpty()) {
                if ($offer->offer_type === 'free_delivery') {
                    $deliveryFee = 0;
                } elseif ($offer->offer_type === 'discount') {
                    if ($offer->discount_type === 'percent') {
                        $offerDiscount += ($subTotal * $offer->discount_value) / 100;
                    } else {
                        $offerDiscount += $offer->discount_value;
                    }
                }
            }
        }

        // ==========================================
        // 3. COUPON ENGINE LOGIC
        // ==========================================
        if ($cart->coupon_code) {
            $coupon = Coupon::where('code', $cart->coupon_code)->first();
            if ($coupon) {
                if ($coupon->type === 'percent') {
                    $couponDiscount = ($subTotal * $coupon->discount_amount) / 100;
                } elseif ($coupon->type === 'fixed') {
                    $couponDiscount = $coupon->discount_amount;
                }
            }
        }

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
     * Check if a specific offer condition is met.
     */
    private function checkOfferCondition($condition, $cart, $items, $subTotal): bool
    {
        switch ($condition->condition_type) {
            case 'min_quantity':
                $totalQty = $items->sum('quantity');
                return $this->evaluateCondition($totalQty, $condition->operator, $condition->value);
            case 'min_weight':
                $totalWeight = 0;
                foreach ($items as $item) {
                    if ($item->product->product_type === 'Sweet') {
                        $totalWeight += $item->unit_value;
                    }
                }
                return $this->evaluateCondition($totalWeight, $condition->operator, $condition->value);
            case 'cart_total':
                return $this->evaluateCondition($subTotal, $condition->operator, $condition->value);
            case 'product_id':
                return $items->where('product_id', $condition->value)->isNotEmpty();
            case 'variant_id':
                return $items->where('variant_id', $condition->value)->isNotEmpty();
            default:
                return true;
        }
    }

    private function evaluateCondition($actual, $operator, $target): bool
    {
        return match($operator) {
            '>=' => $actual >= $target,
            '<=' => $actual <= $target,
            '='  => $actual == $target,
            '>'  => $actual > $target,
            '<'  => $actual < $target,
            default => true,
        };
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
