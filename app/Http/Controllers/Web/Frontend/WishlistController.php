<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to wishlist a product.',
            ], 401);
        }
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to wishlist a product.'
                ], 401);
            }

            $product = Product::findOrFail($id);

            // Check if the villa is already bookmarked
            $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $product->id)->first();

            if ($wishlist) {
                // Remove wishlist
                $user->wishlist()->detach($product->id);
                return response()->json([
                    'success' => true,
                    'action' => 'removed',
                    'is_favourite' => false,
                    'message' => 'Product removed from wishlist.'
                ]);
            } else {
                // Add to bookmarks
                $user->wishlist()->attach($product->id, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return response()->json([
                    'success' => true,
                    'action' => 'added',
                    'is_wishlist' => true,
                    'message' => 'Product added to wishlist.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function remove($id)
    {
        try {
            $wishlist = Wishlist::findOrFail($id);
            $wishlist->delete();

            // Return success response as JSON
            return response()->json([
                'success' => true,
                't-success' => 'Wishlist removed successfully!',
            ]);
        } catch (\Exception $e) {
            // Return error response as JSON
            return response()->json([
                'success' => false,
                't-error' => 'An error occurred while removing the wishlist.',
            ]);
        }
    }

}
