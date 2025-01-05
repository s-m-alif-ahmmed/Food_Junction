<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Add product to wishlist
    public function add(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        // Check if the product is already in the wishlist
        $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();

        if (!$wishlist) {
            // Add product to wishlist
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);

            return response()->json(['status' => 'added']);
        }

        return response()->json(['status' => 'exists']);
    }

    // Remove product from wishlist
    public function remove(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        // Remove product from wishlist
        Wishlist::where('user_id', $user->id)->where('product_id', $productId)->delete();

        return response()->json(['status' => 'removed']);
    }
}
