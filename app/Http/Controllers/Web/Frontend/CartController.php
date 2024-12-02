<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
                        'weight' => $item['weight'],
                    ];
                }
                return null;
            }, $sessionCart);
            // Filter out any null values (products not found)
            $carts = array_filter($carts);
        }

        return view('frontend.pages.cart', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        try {
            // Get the data from the request
            $data = $request->only(['product_id', 'weight']);
            $productId = $data['product_id'];
            $newWeight = $data['weight'];

            // Fetch the product
            $product = Product::find($productId);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found!'], 404);
            }

            // For logged-in users, save to the database
            if (Auth::check()) {
                $userId = Auth::id();
                $existingCart = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if ($existingCart) {
                    // If the product exists, sum the existing weight with the new weight
                    $updatedWight = $existingCart->weight + $newWight;
                    $existingCart->update(['weight' => $updatedWight]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Cart updated with new weight!',
                        'cart' => $existingCart,
                    ]);
                } else {
                    // If the product does not exist, create a new cart item
                    $data['user_id'] = $userId;
                    Cart::create($data);
                    return response()->json([
                        'success' => true,
                        'message' => 'Item added to cart!',
                    ]);
                }
            }
            // For guest users, store cart items in session
            $cart = session()->get('carts', []);

            // Check if the product already exists in the session
            $found = false;
            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $productId) {
                    // Update weight if product exists
                    $cart[$index]['weight'] = $newWeight;
                    $found = true;
                    break;
                }
            }

            // If product not found in session, add new item
            if (!$found) {
                $cart[] = [
                    'product_id' => $productId,
                    'weight' => $newWeight,
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->image,
                        'price' => $product->price,
                        'discount_price' => $product->discount_price,
                        'product_slug' => $product->product_slug,
                    ]
                ];
            }

            // Store updated cart in session
            session()->put('carts', $cart);

            return response()->json([
                'success' => true,
                'message' => $found ? 'Cart updated with new weight!' : 'Item added to cart!',
                'cart' => $cart,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to cart!',
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
                    return redirect()->back()->with([
                        'success' => true,
                        't-success' => 'Item removed from cart.',
                    ]);
                } else {
                    return redirect()->back()->with([
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

                return redirect()->back()->with([
                    'success' => true,
                    't-success' => 'Item removed from cart.',
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                't-error' => 'Failed to remove item from cart.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
