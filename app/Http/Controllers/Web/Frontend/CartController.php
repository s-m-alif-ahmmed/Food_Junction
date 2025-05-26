<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function cart(): View
    {
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
                        'weight' => $item['weight'] ?? null,
                        'quantity' => $item['quantity'] ?? null,
                    ];
                }
                return null;
            }, $sessionCart);
            // Filter out any null values (products not found)
            $carts = array_filter($carts);
            // Convert array to collection
            $carts = collect($carts);
        }
        // Calculate cart totals
        $subTotal = 0;
        $totalSweetWeight = 0;

        $carts = $carts->map(function ($item) use (&$subTotal, &$totalSweetWeight) {
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

            // Create a stdClass object instead of an array to allow object-style access in the view
            $cartItem = new \stdClass();
            $cartItem->product = $product;
            $cartItem->product_slug = $product->product_slug;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = $quantity;
            $cartItem->weight = $weight;
            $cartItem->price = round($price, 2);
            $cartItem->line_total = round($lineTotal, 2);

            return $cartItem;
        });

        // Calculate discounts and totals
        $loginDiscount = Auth::check() ? ($subTotal * 0.05) : 0;
        $deliveryFee = ($totalSweetWeight > 2000) ? 0 : 60;
        $subTotalAfterLoginDiscount = $subTotal - $loginDiscount;
        $total = ($subTotalAfterLoginDiscount + $deliveryFee);

        // Create a stdClass object instead of an array to allow object-style access in the view
        $totalInfo = new \stdClass();
        $totalInfo->login_discount = floor($loginDiscount);
        $totalInfo->total = floor($total);
        $totalInfo->delivery_fee = $deliveryFee;
        $totalInfo->sub_total = floor($subTotal);

        // Pass the carts variable to the view
        return view('frontend.pages.cart', compact('carts', 'totalInfo'));
    }

    public function addToCart(Request $request)
    {
        try {
            // Assign data directly from the request
            $productId = $request->input('product_id');
            $newWeight = $request->input('weight');
            $newQuantity = $request->input('quantity');

            // Fetch the product
            $product = Product::find($productId);

            if (!$product) {
                return response()->json(['success' => false, 't-error' => 'Product not found!'], 404);
            }

            $product_type = $product->product_type;

            // For logged-in users, save to the database
            if (Auth::check()) {
                $userId = Auth::id();
                $existingCart = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if ($existingCart) {
                    // If the product exists, sum the existing weight with the new weight
                    if ($product_type === 'Sweet') {
                        $existingCart->update(['weight' => $existingCart->weight + $newWeight]);
                    } elseif ($product_type === 'Product') {
                        $existingCart->update(['quantity' => $existingCart->quantity + $newQuantity]);
                    }

                    return response()->json([
                        'success' => true,
                        't-success' => 'Cart updated with new weight!',
                        'cart' => $existingCart,
                    ]);
                } else {
                    // If the product does not exist, create a new cart item
                    $data = [
                        'user_id' => $userId,
                        'product_id' => $productId,
                        'quantity' => $newQuantity, // Assuming quantity is relevant for Products
                        'weight' => $newWeight, // Assuming weight is relevant for Sweets
                    ];
                    Cart::create($data);
                    return response()->json([
                        'success' => true,
                        't-success' => 'Item added to cart!',
                    ]);
                }
            }
            // For guest users, store cart items in session
            $cart = session()->get('carts', []);

            // Check if the product already exists in the session
            $found = false;
            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $productId) {
                    if ($product_type === 'Sweet') {
                        $cart[$index]['weight'] += $newWeight;
                    } elseif ($product_type === 'Product') {
                        $cart[$index]['quantity'] += $newQuantity;
                    }
                    $found = true;
                    break;
                }
            }

            // If product not found in session, add new item
            if (!$found) {
                $cart[] = [
                    'product_id' => $productId,
                    'weight' => $product_type === 'Sweet' ? $newWeight : null,
                    'quantity' => $product_type === 'Product' ? $newQuantity : null,
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->image,
                        'price' =>  $product->price,
                        'product_type' => $product_type,
                        'discount_price' => $product->discount_price,
                        'product_slug' => $product->product_slug,
                    ]
                ];
            }

            // Store updated cart in session
            session()->put('carts', $cart);

            session()->forget('applied_coupon');

            return response()->json([
                'success' => true,
                't-success' => $found ? 'Cart updated with new weight!' : 'Item added to cart!',
                'cart' => $cart,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                't-error' => 'Failed to add item to cart!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            // Get the product ID from the request
            $productId = $request->input('product_id');

            // Check if the user is logged in
            if (Auth::check()) {
                // For logged-in users, remove the item from the database
                $userId = Auth::id();
                $cart = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if ($cart) {
                    $cart->delete();

                    return redirect()->back()->with('t-success', 'Item removed from cart.');

                } else {
                    return response()->json([
                        'success' => false,
                        't-error' => 'Item not found in cart.',
                    ], 404);
                }
            } else {
                // For guest users, remove the item from the session
                $cart = session()->get('carts', []);

                // Find the index of the item to be removed
                foreach ($cart as $index => $item) {
                    if ($item['product_id'] == $productId) {
                        unset($cart[$index]);
                        break;
                    }
                }

                // Update the session with the new cart
                session()->put('carts', $cart);

                return redirect()->back()->with('t-success', 'Item removed from cart.');
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart.',
                't-error' => $e->getMessage(),
            ], 500);
        }
    }

}
