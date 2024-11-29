<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            // Get the data from the request
            $data = $request->only(['product_id', 'wight']);
            $productId = $data['product_id'];
            $newWight = $data['wight'];

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
                    $updatedWight = $existingCart->wight + $newWight;
                    $existingCart->update(['wight' => $updatedWight]);
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

            // For guest users, save to session
            $cart = session()->get('cart', []);

            // Check if the product already exists in the session cart
            $found = false;
            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $productId) {
                    // Update the weight
                    $cart[$index]['wight'] += $newWight;
                    $found = true;
                    break;
                }
            }

            // If the product was not found in the session cart, add it
            if (!$found) {
                // Save product details in the session cart
                $cart[] = [
                    'product_id' => $productId,
                    'wight' => $newWight,
                    // Store necessary product attributes
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->image,
                        'price' => $product->price,
                        'discount_price' => $product->discount_price, // if available
                    ],
                ];
            }

            // Update the session with the new cart data
            session()->put('cart', $cart);

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


}
