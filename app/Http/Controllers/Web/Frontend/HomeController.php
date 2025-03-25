<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Faq;
use App\Models\HomeBanner;
use App\Models\HomeBottomBanner;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Video;
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
        $home_banners = HomeBanner::where('status','active')->latest()->get();
        $home_bottom_banner = HomeBottomBanner::first();
        return view('frontend.pages.index',compact('products','home_banners', 'home_bottom_banner'));
    }

    public function faq(): View {
        $faqs = Faq::where('status','active')->latest()->get();
        return view('frontend.pages.faq',compact('faqs'));
    }

    public function about(): View {
        return view('frontend.pages.about-us');
    }

    public function blog(): View {
        return view('frontend.pages.blog');
    }

    public function blogDetail(): View {
        return view('frontend.pages.blog-detail');
    }

    public function video(): View
    {
        $videos = Video::where('status','active')->latest()->get();
        return view('frontend.pages.video', compact('videos'));
    }

    public function products(): View {
        $products = Product::where('status','active')->latest()->get();
        return view('frontend.pages.product',compact('products'));
    }

    public function categoryProduct(string $category_slug): View
    {
        // Fetch the category using the provided slug
        $category = Category::where('category_slug', $category_slug)->where('status', 'active')->first();

        // Check if the category exists
        if (!$category) {
            abort(404, 'Category not found');
        }

        // Fetch products related to the category
        $products = Product::where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('frontend.pages.product-category', compact('products', 'category'));
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
