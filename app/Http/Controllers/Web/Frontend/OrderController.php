<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\CartService;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // ----------------------------------------------------------------
    // COUPON: Apply
    // ----------------------------------------------------------------
    public function couponCheck(Request $request)
    {
        $request->validate(['coupon' => 'required|string']);

        try {
            $coupon = $this->cartService->applyCoupon($request->coupon);
            $cart   = $this->cartService->getCart();

            session()->flash('t-success', 'Coupon applied successfully!');

            return response()->json([
                'success'      => true,
                'message'      => 'Coupon applied successfully!',
                'coupon'       => $coupon->code,
                'sub_total'    => $cart->subtotal,
                'delivery_fee' => $cart->delivery_fee,
                'discount'     => $cart->discount,
                'total'        => $cart->total,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // ----------------------------------------------------------------
    // DELIVERY ZONE: Set Zone
    // ----------------------------------------------------------------
    public function setDeliveryZone(Request $request)
    {
        $request->validate(['zone' => 'required|string']);

        try {
            $cart = $this->cartService->setDeliveryZone($request->zone);

            return response()->json([
                'success'         => true,
                'zone'            => $cart->delivery_zone,
                'delivery_fee'    => $cart->delivery_fee,
                'offer_discount'  => $cart->offer_discount,
                'coupon_discount' => $cart->coupon_discount,
                'subtotal'        => $cart->subtotal,
                'total'           => $cart->total,
                'is_free'         => $cart->delivery_fee <= 0,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // ----------------------------------------------------------------
    // COUPON: Remove
    // ----------------------------------------------------------------
    public function couponRemove(Request $request)
    {
        try {
            $this->cartService->removeCoupon();
            $cart = $this->cartService->getCart();

            session()->flash('t-success', 'Coupon removed successfully!');

            return response()->json([
                'success'      => true,
                'message'      => 'Coupon removed successfully',
                'sub_total'    => $cart->subtotal,
                'delivery_fee' => $cart->delivery_fee,
                'discount'     => $cart->discount,
                'total'        => $cart->total,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to remove coupon.']);
        }
    }

    // ----------------------------------------------------------------
    // CHECKOUT PAGE
    // ----------------------------------------------------------------
    public function checkout(): RedirectResponse|View
    {
        $cart = $this->cartService->getCart();
        $this->cartService->calculateTotals($cart);
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('products')->with('t-error', 'Add products to cart first.');
        }

        $deliveryZones = $this->cartService->getAvailableDeliveryZones($cart);
        return view('frontend.pages.checkout', compact('cart', 'deliveryZones'));
    }

    // ----------------------------------------------------------------
    // PLACE ORDER
    // ----------------------------------------------------------------
    public function newOrder(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'address'         => 'required|string|max:500',
            'email'           => 'nullable|email|max:255',
            'whatsapp_number' => ['nullable', 'regex:/^\d{11}$/'],
            'number'          => ['required', 'regex:/^\d{11}$/'],
            'note'            => 'nullable|string|max:500',
            'all_terms'       => 'required|accepted',
        ], [
            'number.required' => 'The phone number is required.',
            'number.regex'    => 'The phone number must be exactly 11 digits.',
        ]);

        $user = Auth::user();
        $cart = $this->cartService->getCart();
        $this->cartService->calculateTotals($cart);
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('products')->with('t-error', 'Add products to cart first.');
        }

        // ── Coupon & Offer Breakdown ─────────────────────────────────────────
        $coupon       = null;
        $couponCode   = null;
        $couponType   = null;
        $couponValue  = null;

        if ($cart->coupon_code) {
            $coupon = Coupon::where('code', $cart->coupon_code)->first();
            if ($coupon) {
                $couponCode    = $coupon->code;
                $couponType    = $coupon->type;
                $couponValue   = $coupon->discount_amount;
            }
        }

        $couponDiscount = $cart->coupon_discount;
        $offerDiscount  = $cart->offer_discount;

        // If free delivery was triggered, record it
        $isFreeDelivery = $cart->delivery_fee == 0;

        try {
            DB::beginTransaction();

            // ── Create Order ─────────────────────────────────────────────
            $order = Order::create([
                'user_id'          => $user->id ?? null,
                'coupon_id'        => $coupon?->id,

                // Customer
                'name'             => $request->name,
                'email'            => $request->email,
                'number'           => $request->number,
                'whatsapp_number'  => $request->whatsapp_number,
                'address'          => $request->address,
                'note'             => $request->note,
                'all_terms'        => $request->all_terms,

                // Delivery
                'delivery_zone'    => $cart->delivery_zone,
                'delivery_fee'     => $cart->delivery_fee,
                'is_free_delivery' => $isFreeDelivery,

                // Coupon snapshot
                'coupon_code'      => $couponCode,
                'coupon_type'      => $couponType,
                'coupon_value'     => $couponValue,

                // Financials
                'subtotal'         => $cart->subtotal,
                'product_discount' => 0, // future: per-product discounts
                'offer_discount'   => round($offerDiscount, 2),
                'coupon_discount'  => round($couponDiscount, 2),
                'total_discount'   => round($cart->discount, 2),
                'final_total'      => $cart->total,

                // Offer snapshot (which offers were applied)
                'applied_offers'   => null,

                'tracking_id'      => $this->generateTrackingId(),
                'status'           => 'pending',
            ]);

            // ── Create Order Details ─────────────────────────────────────
            foreach ($cart->items as $cartItem) {
                $product = $cartItem->product;
                if (!$product) continue;

                $originalPrice = 0;
                if ($cartItem->variant) {
                    $originalPrice = $cartItem->variant->price;
                } elseif ($product) {
                    $originalPrice = $product->price ?? 0;
                }

                // Ensure valid enum value for unit_type
                $unitType = $cartItem->unit === 'gram' ? 'gram' : 'pcs';

                OrderDetail::create([
                    'order_id'        => $order->id,
                    'product_id'      => $cartItem->product_id,
                    'variant_id'      => $cartItem->variant_id,

                    // Snapshot
                    'product_name'    => $product->name,

                    // Pricing snapshot
                    'original_price'  => $originalPrice,
                    'unit_price'      => $cartItem->unit_price,
                    'discount_amount' => max(0, $originalPrice - $cartItem->unit_price),

                    // Quantity
                    'unit_type'       => $unitType,
                    'unit_value'      => $cartItem->variant_quantity,
                    'quantity'        => $cartItem->quantity,

                    // Line total
                    'total_price'     => $cartItem->total,
                ]);
            }

            // ── Clear Cart ───────────────────────────────────────────────
            $this->cartService->clearCart();

            DB::commit();

            // Store tracking ID in session for the thank-you page
            session(['order' => $order->id]);

            return redirect('/order-complete');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('t-error', 'Failed to place order. Error: ' . $e->getMessage());
        }
    }

    // ----------------------------------------------------------------
    // DIRECT LANDING / SPECIAL OFFER ORDER
    // ----------------------------------------------------------------
    public function directLandingOrder(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
            'address'         => 'required|string|max:500',
            'email'           => 'nullable|email|max:255',
            'whatsapp_number' => ['nullable', 'regex:/^\d{11}$/'],
            'number'          => ['required', 'regex:/^\d{11}$/'],
            'note'            => 'nullable|string|max:500',
            'all_terms'       => 'required|accepted',
            'delivery_zone'   => 'required|string',
            'quantity'        => 'nullable|integer|min:1|max:100',
            'product_id'      => 'nullable|exists:products,id',
            'variant_id'      => 'nullable|exists:product_variants,id',
            'offer_id'        => 'nullable|exists:baklava_offers,id',
        ], [
            'name.required'          => 'Please enter your full name.',
            'number.required'        => 'The phone number is required.',
            'number.regex'           => 'The phone number must be exactly 11 digits (e.g. 017XXXXXXXX).',
            'whatsapp_number.regex'  => 'The WhatsApp number must be 11 digits.',
            'address.required'       => 'Please enter your full delivery address.',
            'all_terms.required'     => 'You must accept the terms and conditions.',
            'all_terms.accepted'     => 'You must accept the terms and conditions.',
            'delivery_zone.required' => 'Please select your delivery zone.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors'  => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Resolve Special Offer & Product
            $offer = null;
            if ($request->offer_id) {
                $offer = \App\Models\BaklavaOffer::find($request->offer_id);
            } elseif ($request->offer_slug) {
                $offer = \App\Models\BaklavaOffer::where('slug', $request->offer_slug)->first();
            }

            $productId = $request->product_id ?? $offer?->product_id;
            $product = $productId ? \App\Models\Product::with('variants')->find($productId) : \App\Models\Product::with('variants')->where('product_slug', 'like', '%baklava%')->first() ?? \App\Models\Product::with('variants')->first();

            $variantId = $request->variant_id ?? $offer?->variant_id;
            $variant = $variantId ? \App\Models\ProductVariant::find($variantId) : $product?->variants?->first();

            $qty = max(1, (int)($request->quantity ?? 1));

            // Determine unit price & package name
            if ($offer && $offer->offer_price) {
                $unitPrice = (float)$offer->offer_price;
                $originalPrice = (float)($offer->regular_price ?? $unitPrice);
                $packageName = $offer->package_title ?? ($product?->name ?? 'Special Offer Package');
            } elseif ($variant) {
                $unitPrice = (float)($variant->sale_price ?? $variant->price);
                $originalPrice = (float)$variant->price;
                $packageName = ($product?->name ?? 'Product') . ' - ' . ($variant->variant_type ?? ($variant->quantity . ' ' . $variant->unit));
            } elseif ($product) {
                $unitPrice = (float)($product->discount_price ?? $product->price);
                $originalPrice = (float)($product->price ?? $unitPrice);
                $packageName = $product->name;
            } else {
                $unitPrice = 1350;
                $originalPrice = 1850;
                $packageName = 'Special Offer Package';
            }

            $subtotal = $unitPrice * $qty;

            // Determine delivery fee
            $deliveryZone = $request->delivery_zone;
            if ($offer) {
                $deliveryFee = ($deliveryZone === 'outside_dhaka')
                    ? (float)($offer->outside_dhaka_delivery_fee ?? 150)
                    : (float)($offer->inside_dhaka_delivery_fee ?? 80);
            } else {
                $deliveryFee = ($deliveryZone === 'outside_dhaka') ? 150 : 80;
            }

            $finalTotal = $subtotal + $deliveryFee;

            // Create Order
            $order = Order::create([
                'user_id'          => $user->id ?? null,
                'coupon_id'        => null,

                // Customer
                'name'             => $request->name,
                'email'            => $request->email,
                'number'           => $request->number,
                'whatsapp_number'  => $request->whatsapp_number,
                'address'          => $request->address,
                'note'             => $request->note,
                'all_terms'        => $request->all_terms,

                // Delivery
                'delivery_zone'    => $deliveryZone,
                'delivery_fee'     => $deliveryFee,
                'is_free_delivery' => $deliveryFee == 0,

                // Coupon snapshot
                'coupon_code'      => null,
                'coupon_type'      => null,
                'coupon_value'     => 0,

                // Financials
                'subtotal'         => $subtotal,
                'product_discount' => max(0, ($originalPrice - $unitPrice) * $qty),
                'offer_discount'   => 0,
                'coupon_discount'  => 0,
                'total_discount'   => max(0, ($originalPrice - $unitPrice) * $qty),
                'final_total'      => $finalTotal,

                'applied_offers'   => null,
                'tracking_id'      => $this->generateTrackingId(),
                'status'           => 'pending',
            ]);

            // Create OrderDetail
            OrderDetail::create([
                'order_id'        => $order->id,
                'product_id'      => $product?->id,
                'variant_id'      => $variant?->id,

                // Snapshot
                'product_name'    => $packageName,

                // Pricing snapshot
                'original_price'  => $originalPrice,
                'unit_price'      => $unitPrice,
                'discount_amount' => max(0, $originalPrice - $unitPrice),

                // Quantity
                'unit_type'       => $variant?->unit === 'gram' ? 'gram' : 'pcs',
                'unit_value'      => $variant?->quantity,
                'quantity'        => $qty,

                // Line total
                'total_price'     => $subtotal,
            ]);

            // Clear cart to avoid conflict with existing cart sessions
            try {
                $this->cartService->clearCart();
            } catch (\Throwable $t) {}

            DB::commit();

            session(['order' => $order->id]);
            session()->flash('t-success', 'আপনার অর্ডারটি সফলভাবে গৃহীত হয়েছে!');

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'      => true,
                    'message'      => 'অর্ডারটি সফলভাবে সম্পন্ন হয়েছে!',
                    'redirect_url' => route('order.confirm'),
                    'tracking_id'  => $order->tracking_id,
                ]);
            }

            return redirect()->route('order.confirm');

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'অর্ডার সম্পন্ন করতে সমস্যা হয়েছে: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('t-error', 'অর্ডার সম্পন্ন করতে সমস্যা হয়েছে: ' . $e->getMessage())->withInput();
        }
    }

    // ----------------------------------------------------------------
    // ORDER COMPLETE PAGE
    // ----------------------------------------------------------------
    public function orderComplete(Request $request)
    {
        $orderId = LaravelSession::get('order');
        $order   = Order::with('items.product')->find($orderId);

        if (!$order) {
            return redirect('/')->withErrors(['error' => 'Order not found.']);
        }

        return view('frontend.pages.confirm-order', compact('order'));
    }

    // ----------------------------------------------------------------
    // CUSTOMER ORDER DETAIL PAGE
    // ----------------------------------------------------------------
    public function orderDetails(Request $request, $tracking_id)
    {
        $order        = Order::where('tracking_id', $tracking_id)->with('items.product', 'coupon')->firstOrFail();
        $orderDetails = $order->items;

        return view('frontend.dashboard.order-detail', compact('orderDetails', 'order'));
    }

    // ----------------------------------------------------------------
    // HELPERS
    // ----------------------------------------------------------------
    private function generateTrackingId(): string
    {
        do {
            $id = strtoupper(\Illuminate\Support\Str::random(10));
        } while (Order::where('tracking_id', $id)->exists());

        return $id;
    }
}
