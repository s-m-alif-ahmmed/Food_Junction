<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DynamicPage;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the welcome page.
     *
     * @return View
     */
    public function index(): View {
        $products = Product::where('status','active')->latest()->get();
        return view('frontend.pages.index',compact('products'));
    }

    public function sweets(): View {
        $products = Product::where('status','active')->latest()->get();
        return view('frontend.pages.product',compact('products'));
    }

    public function detail($product_slug): View
    {
        // Find the product by slug and ensure it's active
        $product = Product::where('status', 'active')
            ->where('product_slug', $product_slug)
            ->firstOrFail();

        $product_reviews = ProductReview::where('status','active')->where('product_id', $product->id)->latest()->get();

        // Pass the product data to the view
        return view('frontend.pages.detail', compact('product','product_reviews'));
    }

    public function cart(): View
    {
        $carts = [];
        if (Auth::check()) {
            // Fetch the user's cart items from the database
            $carts = Cart::where('user_id', Auth::user()->id)->latest()->get();
        } else {
            // Fetch cart items from session for guest users
            $sessionCart = session()->get('cart', []);
            $carts = array_map(function ($item) {
                $product = Product::find($item['product_id']);
                return [
                    'product' => $product,
                    'wight' => $item['wight'],
                ];
            }, $sessionCart);
        }

        return view('frontend.pages.cart', compact('carts'));
    }


    public function checkout(): View {
        return view('frontend.pages.checkout');
    }

    public function confirmOrder(): View {
        return view('frontend.pages.confirm-order');
    }

    public function dynamicPage($page_slug): View {
        $dynamic_page = DynamicPage::where('page_slug', $page_slug)->first();

        // Check if the page exists, otherwise return a 404
        if (!$dynamic_page) {
            abort(404); // Or you can return a custom view for the error
        }

        return view('frontend.pages.dynamic_page', [
            'dynamic_page' => $dynamic_page,
        ]);
    }


}
