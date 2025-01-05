<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $searchTerm = $request->get('search', '');

            // Fetch products based on search criteria
            $searchProducts = Product::where('status', 'active')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
                })
                ->get();
            return response()->json(['searchProducts' => $searchProducts]);
        }

        return response()->json(['error' => 'No Product Found!'], 400);
    }


}
