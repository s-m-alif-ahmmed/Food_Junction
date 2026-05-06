<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('frontend.pages.checkout', compact('cart'));
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

            $isSweet    = $cartItem->unit_type === 'kg';
            $unitValue  = $isSweet ? $cartItem->unit_value : null;
            $quantity   = $isSweet ? 1 : $cartItem->quantity;
            $totalPrice = $cartItem->total_price ?? 0;

            OrderDetail::create([
                'order_id'        => $order->id,
                'product_id'      => $cartItem->product_id,

                // Snapshot
                'product_name'    => $product->name,

                // Pricing snapshot
                'original_price'  => $product->price,
                'unit_price'      => $cartItem->unit_price,
                'discount_amount' => max(0, ($product->price ?? 0) - $cartItem->unit_price),

                // Quantity
                'unit_type'       => $cartItem->unit_type,  // 'kg' or 'pcs'
                'unit_value'      => $unitValue,              // grams/kg for sweets
                'quantity'        => $quantity,
                'variant_unit'    => $cartItem->variant_unit,

                // Line total
                'total_price'     => $totalPrice,
            ]);
        }

        // ── Clear Cart ───────────────────────────────────────────────
        $this->cartService->clearCart();

        // Store tracking ID in session for the thank-you page
        session(['order' => $order->id]);

        return redirect('/order-complete');
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
