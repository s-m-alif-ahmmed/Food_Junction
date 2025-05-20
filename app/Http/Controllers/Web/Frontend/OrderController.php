<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function couponCheck(Request $request)
    {
        $request->validate([
            'coupon' => 'required',
        ]);

        $coupon = Coupon::where('code', $request->coupon)
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired coupon code.'
            ]);
        }

        // Get cart data (same as your checkout method)
        if (Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $sessionCart = session('carts', []);
            $carts = collect($sessionCart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                if (!$product) return null;

                return [
                    'product' => $product,
                    'product_id' => $item['product_id'],
                    'weight' => $item['weight'] ?? 0,
                    'quantity' => $item['quantity'] ?? 0,
                    'price' => $item['price'] ?? 0,
                ];
            })->filter()->values();
        }

        if ($carts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.'
            ]);
        }

        // Calculate cart totals
        $subTotal = 0;
        $totalSweetWeight = 0;

        $mappedCarts = $carts->map(function ($item) use (&$subTotal, &$totalSweetWeight) {
            // Normalize item access (array or object)
            $isArray = is_array($item);
            $product = $isArray ? $item['product'] : $item->product;
            $productType = $product->product_type;
            $quantity = $isArray ? ($item['quantity'] ?? 0) : ($item->quantity ?? 0);
            $weight = $isArray ? ($item['weight'] ?? 0) : ($item->weight ?? 0);
            $price = $product->discount_price ?? $product->price;

            // Calculate line total
            if ($productType === 'Sweet') {
                $gmPrice = $price / 1000;
                $lineTotal = $gmPrice * $weight;
                $subTotal += $lineTotal;
                $totalSweetWeight += $weight;
            } elseif ($productType === 'Product') {
                $lineTotal = $quantity * $price;
                $subTotal += $lineTotal;
            } else {
                $lineTotal = 0;
            }

            return [
                'product' => $product,
                'product_slug' => $product->product_slug,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'weight' => $weight,
                'price' => round($price),
                'line_total' => round($lineTotal),
            ];
        });

        // Calculate discounts and totals
        $loginDiscount = Auth::check() ? ($subTotal * 0.05) : 0;
        $deliveryFee = ($totalSweetWeight > 2000) ? 0 : 60;
        $subTotalAfterLoginDiscount = $subTotal - $loginDiscount;

        // Calculate coupon discount
        $couponDiscount = 0;
        if ($coupon->type === 'percent'){
            $couponDiscount = ($subTotal * $coupon->discount_amount) / 100;
        } elseif ($coupon->type === 'fixed'){
            $couponDiscount = $subTotal - $coupon->discount_amount;
        }

        $total = ($subTotalAfterLoginDiscount + $deliveryFee) - $couponDiscount;

        // Store coupon in session
        session([
            'applied_coupon' => [
                'code' => $coupon->code,
                'id' => $coupon->id,
                'discount' => round($couponDiscount),
                'type' => $coupon->type,
                'amount' => $coupon->discount_amount,
                'total' => round($total),
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'coupon' => $coupon->code,
            'login_discount' => round($loginDiscount),
            'sub_total' => round($subTotal),
            'delivery_fee' => $deliveryFee,
        ]);
    }

    public function couponRemove(Request $request)
    {
        $request->session()->forget('applied_coupon');

        return response()->json([
            'success' => true,
            'message' => 'Coupon removed successfully'
        ]);
    }

    public function checkout(): RedirectResponse|View
    {
        // Get carts for authenticated user or from session
        if (Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $sessionCart = session('carts', []);
            $carts = collect($sessionCart)->map(function ($item) {
                $product = Product::find($item['product_id']);
                if (!$product) return null;

                return [
                    'product' => $product,
                    'product_id' => $item['product_id'],
                    'weight' => $item['weight'] ?? null,
                    'quantity' => $item['quantity'] ?? null,
                ];
            })->filter()->values();
        }

        // Check if cart is empty
        if ($carts->isEmpty()) {
            return redirect()->route('products')->with('t-error', 'Add products to cart first.');
        }

        // Calculate cart totals
        $subTotal = 0;
        $totalSweetWeight = 0;

        $mappedCarts = $carts->map(function ($item) use (&$subTotal, &$totalSweetWeight) {
            // Normalize item access (array or object)
            $isArray = is_array($item);
            $product = $isArray ? $item['product'] : $item->product;
            $productType = $product->product_type;
            $quantity = $isArray ? ($item['quantity'] ?? 0) : ($item->quantity ?? 0);
            $weight = $isArray ? ($item['weight'] ?? 0) : ($item->weight ?? 0);
            $price = $product->discount_price ?? $product->price;

            // Calculate line total
            if ($productType === 'Sweet') {
                $gmPrice = $price / 1000;
                $lineTotal = $gmPrice * $weight;
                $subTotal += $lineTotal;
                $totalSweetWeight += $weight;
            } elseif ($productType === 'Product') {
                $lineTotal = $quantity * $price;
                $subTotal += $lineTotal;
            } else {
                $lineTotal = 0;
            }

            return [
                'product' => $product,
                'product_slug' => $product->product_slug,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'weight' => $weight,
                'price' => $price,
                'line_total' => round($lineTotal, 2),
            ];
        });

        // Calculate final totals
        $loginDiscount = Auth::check() ? ($subTotal * 0.05) : 0;
        $deliveryFee = ($totalSweetWeight > 2000) ? 0 : 60;
        $total = ($subTotal + $deliveryFee) - $loginDiscount;

        $totalInfo = [
            'login_discount' => round($loginDiscount, 2),
            'total' => round($total, 2),
            'sub_total' => round($subTotal, 2),
            'delivery_fee' => $deliveryFee,
        ];

        return view('frontend.pages.checkout', [
            'carts' => $mappedCarts,
            'total_info' => $totalInfo,
        ]);
    }


    public function newOrder(Request $request)
    {
        $validated = $request->validate([
            'delivery_fee' => 'required|numeric',
            'coupon_id' => 'nullable|exists:coupons,id',
            'discount_amount' => 'nullable|numeric',
            'login_discount' => 'nullable|numeric',
            'estimate_total' => 'nullable|numeric',
            'order_total' => 'required|numeric',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'whatsapp_number' => ['nullable', 'regex:/^\d{11}$/'],
            'number' => ['required', 'regex:/^\d{11}$/'],
            'note' => 'nullable|string|max:255',
            'all_terms' => 'required|accepted',
        ], [
            'number.required' => 'The phone number is required.',
            'number.regex' => 'The phone number must be exactly 11 digits.',
        ]);

        $user = Auth::user();

        $cartItems = $user
            ? Cart::with('product')->where('user_id', $user->id)->get()
            : collect(session('carts', []));

        $discountCoupon = session('discount_coupon', []);
        $couponId = $discountCoupon['coupon_id'] ?? null;
        $discountAmount = $discountCoupon['discount'] ?? 0;

        $order = new Order([
            'user_id' => $user->id ?? null,
            'delivery_fee' => $request->delivery_fee,
            'coupon_id' => $couponId,
            'discount_amount' => $discountAmount,
            'login_discount' => $request->login_discount,
            'estimate_total' => $request->estimate_total,
            'order_total' => $request->order_total,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'number' => $request->number,
            'note' => $request->note,
            'all_terms' => $request->all_terms,
            'tracking_id' => $this->generateTrackingId(),
        ]);
        $order->save();

        // Save order details
        foreach ($cartItems as $cart) {
            $orderDetail = new OrderDetail(['order_id' => $order->id]);
            if ($user) {
                $orderDetail->product_id = $cart->product->id;
                $orderDetail->weight = $cart->weight;
                $orderDetail->quantity = $cart->quantity;
            } else {
                $orderDetail->product_id = $cart['product_id'];
                $orderDetail->weight = $cart['weight'];
                $orderDetail->quantity = $cart['quantity'];
            }
            $orderDetail->save();
        }

        // Clear cart and coupon session
        if ($user) {
            Cart::where('user_id', $user->id)->delete();
        } else {
            session()->forget('carts');
        }
        session()->forget('discount_coupon');

        // Store order ID for order complete view
        session(['order' => $order->id]);

        return redirect('/order-complete');
    }

    public function orderComplete(Request $request)
    {
        // Retrieve the order ID from the session
        $orderId = LaravelSession::get('order'); // Get the order ID from the session

        // Retrieve the actual order using the order ID
        $order = Order::find($orderId); // Fetch the Order model based on the ID

        // Check if the order exists
        if (!$order) {
            // Handle case if the order does not exist (e.g., invalid session or expired order)
            return redirect('/')->withErrors(['error' => 'Order not found']);
        }

        // Pass the order to the view
        return view('frontend.pages.confirm-order', compact('order'));
    }

    public function orderDetails(Request $request, $tracking_id)
    {
        $user = Auth::user();
        $order = Order::where('tracking_id', $tracking_id)->firstOrFail();

        $orderDetails = OrderDetail::where('order_id', $order->id)->latest()->get();

        // Pass the order to the view
        return view('frontend.dashboard.order-detail', compact('orderDetails','order'));
    }


    private function generateTrackingId()
    {
        $length = 10; // Fixed length
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $trackingId = '';

        for ($i = 0; $i < $length; $i++) { // Changed from <= to < for correct length
            $trackingId .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $trackingId;
    }

}
