<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BaklavaOffer;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Cart;
use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Faq;
use App\Models\HomeBanner;
use App\Models\HomeBottomBanner;
use App\Models\Offer;
use App\Models\OfferCondition;
use App\Models\OfferReward;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductVariant;
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
        $home_banners = HomeBanner::with('offers')->where('status', 'active')->latest()->get();
        $home_bottom_banner = HomeBottomBanner::first();

        // Offer Products: Products with discounted variants OR linked to an active offer (condition or reward)
        $activeOfferIds = Offer::active()->pluck('id')->toArray();

        $productIdsFromConditions = OfferCondition::whereIn('offer_id', $activeOfferIds)
            ->where('condition_type', 'product_id')
            ->pluck('value')
            ->toArray();

        $variantIdsFromConditions = OfferCondition::whereIn('offer_id', $activeOfferIds)
            ->where('condition_type', 'variant_id')
            ->pluck('value')
            ->toArray();

        $productIdsFromRewards = OfferReward::whereIn('offer_id', $activeOfferIds)
            ->whereNotNull('product_id')
            ->pluck('product_id')
            ->toArray();

        $variantIdsFromRewards = OfferReward::whereIn('offer_id', $activeOfferIds)
            ->whereNotNull('variant_id')
            ->pluck('variant_id')
            ->toArray();

        $allOfferVariantIds = array_unique(array_merge($variantIdsFromConditions, $variantIdsFromRewards));
        $productIdsFromVariants = ProductVariant::whereIn('id', $allOfferVariantIds)->pluck('product_id')->toArray();

        $allOfferProductIds = array_unique(array_merge($productIdsFromConditions, $productIdsFromRewards, $productIdsFromVariants));

        $offer_products = Product::where('status', 'active')
            ->where(function($query) use ($allOfferProductIds) {
                $query->whereHas('variants', function($q) {
                          $q->whereNotNull('sale_price')->where('status', 'Active');
                      })
                      ->orWhereIn('id', $allOfferProductIds);
            })
            ->with(['variants' => function($q) {
                $q->where('status', 'Active');
            }])
            ->latest()
            ->get();

        // All Products: Just everything active
        $all_products = Product::where('status', 'active')->latest()->get();

        return view('frontend.pages.index', compact(
            'offer_products',
            'all_products',
            'home_banners',
            'home_bottom_banner'
        ));
    }

    public function faq(): View {
        $faqs = Faq::where('status','active')->latest()->get();
        return view('frontend.pages.faq',compact('faqs'));
    }

    public function about(): View {
        return view('frontend.pages.about-us');
    }

    public function offerDetail($id): View {
        $offer = Offer::with(['conditions', 'rewards'])->findOrFail($id);

        if ($offer->applies_to == 'product') {
            $productIds = $offer->conditions->where('condition_type', 'product_id')->pluck('value');
            $products = Product::with('variants')->whereIn('id', $productIds)->where('status', 'active')->paginate(12);
        } else {
            $products = Product::with('variants')->where('status', 'active')->paginate(12);
        }

        return view('frontend.pages.offer-detail', compact('offer', 'products'));
    }

    public function blog(): View {
        $blogs = Blog::where('status','active')->latest()->paginate(12);
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function blogDetail($slug): View {
        $blog = Blog::where('slug', $slug)->where('status', 'active')->first();
        if (!$blog) {
            abort(404);
        }

        $blog_comments = BlogComment::where('blog_id', $blog->id)->where('status', 'active')->latest()->get();

        $latest_blogs = Blog::where('status','active')->latest()->get();
        return view('frontend.pages.blog-detail', compact('blog', 'latest_blogs', 'blog_comments'));
    }

    public function video(): View
    {
        $videos = Video::where('status','active')->latest()->paginate(12);
        return view('frontend.pages.video', compact('videos'));
    }

    public function products(): View {
        $products = Product::where('status','active')->latest()->paginate(12);
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
            ->paginate(12);

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

    public function baklavaOffer(): View {
        $data = BaklavaOffer::where('slug', 'baklava-offer')->first() ?? BaklavaOffer::getSettings();

        $linkedProduct = $data->product_id ? Product::with('variants')->find($data->product_id) : null;
        $baklavaProduct = $linkedProduct ?? Product::where('product_slug', 'like', '%baklava%')
            ->orWhere('name', 'like', '%Baklava%')
            ->orWhere('name', 'like', '%বাকলাভা%')
            ->with('variants')
            ->first();

        $defaultProduct = $baklavaProduct ?? Product::with('variants')->first();

        return view('frontend.pages.baklava-offer', compact('data', 'baklavaProduct', 'defaultProduct'));
    }

    public function specialOffer(string $slug): View {
        $data = BaklavaOffer::where('slug', $slug)->firstOrFail();

        $linkedProduct = $data->product_id ? Product::with('variants')->find($data->product_id) : null;
        $baklavaProduct = $linkedProduct ?? Product::where('product_slug', 'like', '%baklava%')
            ->orWhere('name', 'like', '%Baklava%')
            ->orWhere('name', 'like', '%বাকলাভা%')
            ->with('variants')
            ->first();

        $defaultProduct = $baklavaProduct ?? Product::with('variants')->first();

        return view('frontend.pages.baklava-offer', compact('data', 'baklavaProduct', 'defaultProduct'));
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
