<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout(): View {
        $carts = [];

        if (Auth::check()) {
            // Fetch the user's cart items from the database
            $carts = Cart::where('user_id', Auth::user()->id)->latest()->get();
        } else {
            // Fetch cart items from session for guest users
            $sessionCart = session()->get('carts', []);

            // Prepare the cart data
            $carts = array_map(function ($item) {
                $product = Product::find($item['product_id']);

                // Return the product and weight data
                if ($product) {
                    return [
                        'product' => $product,
                        'weight' => $item['weight'],
                    ];
                }
                return null;
            }, $sessionCart);
            // Filter out any null values (products not found)
            $carts = array_filter($carts);
        }

        return view('frontend.pages.checkout', compact('carts'));
    }

    public function newOrder(Request $request)
    {
        // Validate request data
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

        // Retrieve user if authenticated
        $user = Auth::user();

        // Handle authenticated and guest users differently
        if ($user) {
            // For authenticated users, fetch cart items from database
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        } else {
            // For guest users, fetch cart items from session
            $cartItems = session()->get('carts', []);
        }

        // Initialize the order
        $this->order = new Order();
        $this->order->user_id = $user ? $user->id : null;
        $this->order->delivery_fee = $request->delivery_fee;
        $this->order->coupon_id = $request->coupon_id ?? null; // Handle coupon logic here
        $this->order->discount_amount = $request->discount_amount ?? null;
        $this->order->login_discount = $request->login_discount ?? null;
        $this->order->estimate_total = $request->estimate_total ?? null;
        $this->order->order_total = $request->order_total;
        $this->order->name = $request->name;
        $this->order->address = $request->address;
        $this->order->email = $request->email ?? null;
        $this->order->whatsapp_number = $request->whatsapp_number ?? null;
        $this->order->number = $request->number;
        $this->order->note = $request->note ?? null;
        $this->order->all_terms = $request->all_terms;
        $this->order->tracking_id = $this->generateTrackingId();
        $this->order->save();

        // Add order details from the cart
        foreach ($cartItems as $cart) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $this->order->id;
            $orderDetail->product_id = $cart['product']['id'] ?? $cart->product->id; // Ensure compatibility for both guest and authenticated users
            $orderDetail->weight = $cart['weight'] ?? $cart->weight;
            $orderDetail->save();
        }

        // Clear the cart after placing the order
        if ($user) {
            // For authenticated users, delete the cart items
            Cart::where('user_id', $user->id)->delete();
        } else {
            // For guest users, remove the cart from session
            session()->forget('carts');
        }

        // Store the order ID in the session for later use (in order complete view)
        LaravelSession::put('order', $this->order->id);

        // Redirect to the order completion page
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
