<?php

namespace App\Http\Controllers\Web\Backend\Product;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BaklavaOffer;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of special offer landing page products.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = BaklavaOffer::with(['product', 'variant'])->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $imgUrl = !empty($row->hero_image) ? asset($row->hero_image) : (!empty($row->collage_image) ? asset($row->collage_image) : asset('frontend/images/default/food_junction.png'));
                    return '<img src="' . $imgUrl . '" alt="' . htmlspecialchars($row->name ?? 'Offer') . '" style="width: 55px; height: 55px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">';
                })
                ->addColumn('name_info', function ($row) {
                    $name = htmlspecialchars($row->name ?? $row->hero_title ?? 'Special Offer');
                    $slug = htmlspecialchars($row->slug ?? 'offer');
                    $publicUrl = url('special-offer/' . $slug);

                    return '<div>
                                <div class="fw-bold text-dark fs-14">' . $name . '</div>
                                <div class="text-muted fs-12 mt-1">
                                    <span class="badge bg-light text-primary border me-1"><i class="fa fa-link me-1"></i>/' . $slug . '</span>
                                    <span class="text-secondary">' . htmlspecialchars(Str::limit($row->offer_headline ?? '', 35)) . '</span>
                                </div>
                            </div>';
                })
                ->addColumn('linked_product', function ($row) {
                    if ($row->product) {
                        $pName = htmlspecialchars($row->product->name ?? '--');
                        $vName = $row->variant ? ' (' . htmlspecialchars($row->variant->name ?? '') . ')' : '';
                        return '<span class="fw-semibold text-dark">' . $pName . $vName . '</span>';
                    }
                    return '<span class="text-muted font-italic">Default Baklava</span>';
                })
                ->addColumn('pricing', function ($row) {
                    return '<div>
                                <span class="fw-bold text-danger fs-15">৳ ' . number_format($row->offer_price, 2) . '</span>
                                <br><del class="text-muted fs-12">৳ ' . number_format($row->regular_price, 2) . '</del>
                            </div>';
                })
                ->addColumn('status', function ($row) {
                    $backgroundColor  = $row->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $row->status == "active" ? '26px' : '2px';
                    $sliderStyles     = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:20px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $row->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $row->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $row->id . '" class="form-check-label"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $publicUrl = url('special-offer/' . ($row->slug ?? 'baklava-offer'));

                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="' . route('special-offers.show', ['id' => $row->id]) . '" class="btn btn-info text-white" title="Show Details">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="' . route('special-offers.edit', ['id' => $row->id]) . '" class="btn btn-primary text-white" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="' . $publicUrl . '" target="_blank" class="btn btn-success text-white" title="Preview Live Page">
                                    <i class="fe fe-external-link"></i>
                                </a>
                                <button type="button" onclick="copyLandingLink(\'' . $publicUrl . '\')" class="btn btn-warning text-dark" title="Copy Public URL">
                                    <i class="fe fe-copy"></i>
                                </button>
                                <button type="button" onclick="showDeleteConfirm(' . $row->id . ')" class="btn btn-danger text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </button>
                            </div>';
                })
                ->rawColumns(['image', 'name_info', 'linked_product', 'pricing', 'status', 'action'])
                ->make();
        }

        return view('backend.layouts.special-offer.index');
    }

    /**
     * Show the form for creating a new special offer page.
     */
    public function create(): View
    {
        $products = Product::with('variants')->where('status', 'active')->get();
        $defaultIngredients = BaklavaOffer::getDefaultIngredients();
        $defaultTrustBadges = BaklavaOffer::getDefaultTrustBadges();

        return view('backend.layouts.special-offer.create', compact('products', 'defaultIngredients', 'defaultTrustBadges'));
    }

    /**
     * Store a newly created special offer page in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'                       => 'required|string|max:255',
                'slug'                       => 'nullable|string|max:255|unique:baklava_offers,slug',
                'product_id'                 => 'nullable|exists:products,id',
                'variant_id'                 => 'nullable|exists:product_variants,id',
                'regular_price'              => 'required|numeric|min:0',
                'offer_price'                => 'required|numeric|min:0',
                'inside_dhaka_delivery_fee'  => 'required|numeric|min:0',
                'outside_dhaka_delivery_fee' => 'required|numeric|min:0',
                'hero_image'                 => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'collage_image'              => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'why_image'                  => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'video_file'                 => 'nullable|mimes:mp4,mov,ogg,qt|max:51200',
                'new_review_images.*'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = !empty($request->slug) ? Str::slug($request->slug) : Str::slug($request->name);
            // Ensure unique slug
            $originalSlug = $slug;
            $count = 1;
            while (BaklavaOffer::where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }

            $offer = new BaklavaOffer();
            $offer->name                       = $request->name;
            $offer->slug                       = $slug;
            $offer->product_id                 = $request->product_id;
            $offer->variant_id                 = $request->variant_id;
            $offer->badge_text                 = $request->badge_text ?? '★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★';
            $offer->hero_title                 = $request->hero_title ?? $request->name;
            $offer->offer_headline             = $request->offer_headline;
            $offer->offer_subtext              = $request->offer_subtext;
            $offer->regular_price              = $request->regular_price;
            $offer->offer_price                = $request->offer_price;
            $offer->save_amount                = $request->save_amount;
            $offer->video_url                  = $request->video_url;

            $offer->ingredient_title           = $request->ingredient_title ?? 'INGREDIENTS';
            $offer->ingredient_subtitle        = $request->ingredient_subtitle;

            $offer->reviews_title              = $request->reviews_title ?? 'Trusted by 5000+ Happy Customers';
            $offer->reviews_subtitle           = $request->reviews_subtitle;

            $offer->why_title                  = $request->why_title ?? 'Why We Made This?';
            $offer->why_subtitle               = $request->why_subtitle;
            $offer->why_heading                = $request->why_heading ?? 'Delivery All Over Bangladesh';
            $offer->why_desc_1                 = $request->why_desc_1;
            $offer->why_desc_2                 = $request->why_desc_2;

            $offer->guarantee_1_title          = $request->guarantee_1_title ?? 'Cash On Delivery Available';
            $offer->guarantee_1_text           = $request->guarantee_1_text ?? 'পণ্য হাতে পেয়ে চেক করে মূল্য পরিশোধ করুন';
            $offer->guarantee_2_title          = $request->guarantee_2_title ?? '100% Secure Packaging';
            $offer->guarantee_2_text           = $request->guarantee_2_text ?? 'নিরাপদ ও স্বাস্থ্যসম্মত ভ্যাকুয়াম সিল প্যাকেজিং';

            $offer->package_title              = $request->package_title ?? $request->name;
            $offer->package_subtitle           = $request->package_subtitle ?? 'সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ';
            $offer->inside_dhaka_delivery_fee  = $request->inside_dhaka_delivery_fee ?? 80;
            $offer->outside_dhaka_delivery_fee = $request->outside_dhaka_delivery_fee ?? 150;
            $offer->whatsapp_number            = $request->whatsapp_number ?? '8801672756634';
            $offer->status                     = $request->status ?? 'active';

            // Hero image upload
            if ($request->hasFile('hero_image')) {
                $offer->hero_image = Helper::fileUpload($request->file('hero_image'), 'special-offers', uniqid('hero_'));
            } else {
                $offer->hero_image = 'frontend/images/landing/baklava/hero_tray.png';
            }

            // Collage image upload
            if ($request->hasFile('collage_image')) {
                $offer->collage_image = Helper::fileUpload($request->file('collage_image'), 'special-offers', uniqid('collage_'));
            } else {
                $offer->collage_image = 'frontend/images/landing/baklava/collage_box.jpg';
            }

            // Why platter image upload
            if ($request->hasFile('why_image')) {
                $offer->why_image = Helper::fileUpload($request->file('why_image'), 'special-offers', uniqid('why_'));
            } else {
                $offer->why_image = 'frontend/images/landing/baklava/why_platter.jpg';
            }

            // Video upload
            if ($request->hasFile('video_file')) {
                $videoPath = Helper::fileUpload($request->file('video_file'), 'special-offers', uniqid('video_'));
                if ($videoPath) {
                    $offer->video_url = asset($videoPath);
                }
            }

            // Ingredients
            $ingredients = [];
            $ingNames = $request->input('ingredient_names', ['দেশী গাওয়া ঘি', 'প্রিমিয়াম পেস্তা', 'জাম্বু কাজু', 'প্রাকৃতিক মধু', 'প্রিমিয়াম ফ্লাওয়ার']);
            $defaultIngImgs = [
                'frontend/images/landing/baklava/ing_ghee.jpg',
                'frontend/images/landing/baklava/ing_pista.jpg',
                'frontend/images/landing/baklava/ing_kaju.jpg',
                'frontend/images/landing/baklava/ing_honey.jpg',
                'frontend/images/landing/baklava/ing_flour.jpg',
            ];
            foreach ($ingNames as $idx => $name) {
                $imgPath = $defaultIngImgs[$idx] ?? 'frontend/images/landing/baklava/ing_ghee.jpg';
                if ($request->hasFile("ingredient_images.{$idx}")) {
                    $uploaded = Helper::fileUpload($request->file("ingredient_images.{$idx}"), 'special-offers', uniqid("ing_{$idx}_"));
                    if ($uploaded) {
                        $imgPath = $uploaded;
                    }
                }
                $ingredients[] = ['name' => $name, 'image' => $imgPath];
            }
            $offer->ingredients = $ingredients;

            // Trust badges
            $badges = [];
            $titles = $request->input('trust_badge_titles', ['Handmade in Bangladesh', 'Premium Gift Packaging', 'Carefully Finished by Hand', 'Nationwide Delivery']);
            $subtitles = $request->input('trust_badge_subtitles', ['সম্পূর্ণ হাতে তৈরি ফ্রেশ', 'আকর্ষণীয় গিফট বক্স ফ্রি', 'নিখুঁত ও হাইজেনিক ফিনিশ', 'সারাদেশে হোম ডেলিভারি']);
            $icons = $request->input('trust_badge_icons', ['fa-hands-holding', 'fa-gift', 'fa-medal', 'fa-truck-fast']);

            foreach ($titles as $idx => $title) {
                $badges[] = [
                    'title'    => $title,
                    'subtitle' => $subtitles[$idx] ?? '',
                    'icon'     => $icons[$idx] ?? 'fa-check',
                ];
            }
            $offer->trust_badges = $badges;

            // Reviews
            $reviews = [];
            if ($request->hasFile('new_review_images')) {
                foreach ($request->file('new_review_images') as $i => $revImg) {
                    $revPath = Helper::fileUpload($revImg, 'special-offers/reviews', uniqid("review_{$i}_"));
                    if ($revPath) {
                        $reviews[] = $revPath;
                    }
                }
            }
            if (empty($reviews)) {
                $reviews = BaklavaOffer::getDefaultReviews();
            }
            $offer->reviews = $reviews;

            $offer->save();

            return redirect()->route('special-offers.index')->with('t-success', 'Special Offer Landing Page created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified special offer page details.
     */
    public function show(int $id): View
    {
        $data = BaklavaOffer::with(['product', 'variant'])->findOrFail($id);
        return view('backend.layouts.special-offer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified special offer page.
     */
    public function edit(int $id): View
    {
        $data = BaklavaOffer::findOrFail($id);
        $products = Product::with('variants')->where('status', 'active')->get();

        return view('backend.layouts.special-offer.edit', compact('data', 'products'));
    }

    /**
     * Update the specified special offer page in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'                       => 'required|string|max:255',
                'slug'                       => 'nullable|string|max:255|unique:baklava_offers,slug,' . $id,
                'product_id'                 => 'nullable|exists:products,id',
                'variant_id'                 => 'nullable|exists:product_variants,id',
                'regular_price'              => 'required|numeric|min:0',
                'offer_price'                => 'required|numeric|min:0',
                'inside_dhaka_delivery_fee'  => 'required|numeric|min:0',
                'outside_dhaka_delivery_fee' => 'required|numeric|min:0',
                'hero_image'                 => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'collage_image'              => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'why_image'                  => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
                'video_file'                 => 'nullable|mimes:mp4,mov,ogg,qt|max:51200',
                'new_review_images.*'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $offer = BaklavaOffer::findOrFail($id);

            $slug = !empty($request->slug) ? Str::slug($request->slug) : ($offer->slug ?? Str::slug($request->name));

            $offer->name                       = $request->name;
            $offer->slug                       = $slug;
            $offer->product_id                 = $request->product_id;
            $offer->variant_id                 = $request->variant_id;
            $offer->badge_text                 = $request->badge_text;
            $offer->hero_title                 = $request->hero_title;
            $offer->offer_headline             = $request->offer_headline;
            $offer->offer_subtext              = $request->offer_subtext;
            $offer->regular_price              = $request->regular_price;
            $offer->offer_price                = $request->offer_price;
            $offer->save_amount                = $request->save_amount;
            $offer->video_url                  = $request->video_url;

            $offer->ingredient_title           = $request->ingredient_title;
            $offer->ingredient_subtitle        = $request->ingredient_subtitle;

            $offer->reviews_title              = $request->reviews_title;
            $offer->reviews_subtitle           = $request->reviews_subtitle;

            $offer->why_title                  = $request->why_title;
            $offer->why_subtitle               = $request->why_subtitle;
            $offer->why_heading                = $request->why_heading;
            $offer->why_desc_1                 = $request->why_desc_1;
            $offer->why_desc_2                 = $request->why_desc_2;

            $offer->guarantee_1_title          = $request->guarantee_1_title;
            $offer->guarantee_1_text           = $request->guarantee_1_text;
            $offer->guarantee_2_title          = $request->guarantee_2_title;
            $offer->guarantee_2_text           = $request->guarantee_2_text;

            $offer->package_title              = $request->package_title;
            $offer->package_subtitle           = $request->package_subtitle;
            $offer->inside_dhaka_delivery_fee  = $request->inside_dhaka_delivery_fee;
            $offer->outside_dhaka_delivery_fee = $request->outside_dhaka_delivery_fee;
            $offer->whatsapp_number            = $request->whatsapp_number;
            $offer->status                     = $request->status ?? 'active';

            // Handle Hero Image
            if ($request->hasFile('hero_image')) {
                if ($offer->hero_image && str_starts_with($offer->hero_image, 'uploads/') && file_exists(public_path($offer->hero_image))) {
                    Helper::fileDelete(public_path($offer->hero_image));
                }
                $imagePath = Helper::fileUpload($request->file('hero_image'), 'special-offers', uniqid('hero_'));
                if ($imagePath) {
                    $offer->hero_image = $imagePath;
                }
            }

            // Handle Collage Image
            if ($request->hasFile('collage_image')) {
                if ($offer->collage_image && str_starts_with($offer->collage_image, 'uploads/') && file_exists(public_path($offer->collage_image))) {
                    Helper::fileDelete(public_path($offer->collage_image));
                }
                $imagePath = Helper::fileUpload($request->file('collage_image'), 'special-offers', uniqid('collage_'));
                if ($imagePath) {
                    $offer->collage_image = $imagePath;
                }
            }

            // Handle Why Platter Image
            if ($request->hasFile('why_image')) {
                if ($offer->why_image && str_starts_with($offer->why_image, 'uploads/') && file_exists(public_path($offer->why_image))) {
                    Helper::fileDelete(public_path($offer->why_image));
                }
                $imagePath = Helper::fileUpload($request->file('why_image'), 'special-offers', uniqid('why_'));
                if ($imagePath) {
                    $offer->why_image = $imagePath;
                }
            }

            // Handle Video File Upload
            if ($request->hasFile('video_file')) {
                $videoPath = Helper::fileUpload($request->file('video_file'), 'special-offers', uniqid('video_'));
                if ($videoPath) {
                    $offer->video_url = asset($videoPath);
                }
            }

            // Handle Ingredients
            $ingredients = $offer->ingredients ?? [];
            if ($request->has('ingredient_names')) {
                foreach ($request->input('ingredient_names', []) as $idx => $name) {
                    if (isset($ingredients[$idx])) {
                        $ingredients[$idx]['name'] = $name;
                    } else {
                        $ingredients[$idx] = ['name' => $name, 'image' => 'frontend/images/landing/baklava/ing_ghee.jpg'];
                    }

                    if ($request->hasFile("ingredient_images.{$idx}")) {
                        $ingImg = $request->file("ingredient_images.{$idx}");
                        $ingPath = Helper::fileUpload($ingImg, 'special-offers', uniqid("ing_{$idx}_"));
                        if ($ingPath) {
                            $ingredients[$idx]['image'] = $ingPath;
                        }
                    }
                }
                $offer->ingredients = $ingredients;
            }

            // Handle Trust Badges
            if ($request->has('trust_badge_titles')) {
                $badges = [];
                $titles = $request->input('trust_badge_titles', []);
                $subtitles = $request->input('trust_badge_subtitles', []);
                $icons = $request->input('trust_badge_icons', []);

                foreach ($titles as $idx => $title) {
                    $badges[] = [
                        'title'    => $title,
                        'subtitle' => $subtitles[$idx] ?? '',
                        'icon'     => $icons[$idx] ?? 'fa-check',
                    ];
                }
                $offer->trust_badges = $badges;
            }

            // Handle Review Screenshots
            $reviews = $offer->reviews ?? [];
            if ($request->hasFile('new_review_images')) {
                foreach ($request->file('new_review_images') as $i => $revImg) {
                    $revPath = Helper::fileUpload($revImg, 'special-offers/reviews', uniqid("review_{$i}_"));
                    if ($revPath) {
                        $reviews[] = $revPath;
                    }
                }
                $offer->reviews = $reviews;
            }

            $offer->save();

            return redirect()->route('special-offers.index')->with('t-success', 'Special Offer Landing Page updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified special offer page from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $offer = BaklavaOffer::findOrFail($id);

            // Delete files if stored in uploads
            if ($offer->hero_image && str_starts_with($offer->hero_image, 'uploads/') && file_exists(public_path($offer->hero_image))) {
                Helper::fileDelete(public_path($offer->hero_image));
            }
            if ($offer->collage_image && str_starts_with($offer->collage_image, 'uploads/') && file_exists(public_path($offer->collage_image))) {
                Helper::fileDelete(public_path($offer->collage_image));
            }
            if ($offer->why_image && str_starts_with($offer->why_image, 'uploads/') && file_exists(public_path($offer->why_image))) {
                Helper::fileDelete(public_path($offer->why_image));
            }

            $offer->delete();

            return response()->json([
                't-success' => true,
                'message'   => 'Special Offer Landing Page deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-success' => false,
                'message'   => 'Failed to delete: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle status between active and inactive.
     */
    public function status(int $id): JsonResponse
    {
        try {
            $offer = BaklavaOffer::findOrFail($id);
            $offer->status = $offer->status === 'active' ? 'inactive' : 'active';
            $offer->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated to ' . ucfirst($offer->status) . ' successfully.',
                'data'    => $offer->status,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a single review screenshot image by index for a specific offer.
     */
    public function deleteReview(Request $request, int $id, int $index): JsonResponse | RedirectResponse
    {
        try {
            $offer = BaklavaOffer::findOrFail($id);
            $reviews = $offer->reviews ?? [];

            if (isset($reviews[$index])) {
                $imgPath = $reviews[$index];
                if (str_starts_with($imgPath, 'uploads/') && file_exists(public_path($imgPath))) {
                    Helper::fileDelete(public_path($imgPath));
                }

                array_splice($reviews, $index, 1);
                $offer->reviews = $reviews;
                $offer->save();

                if ($request->ajax()) {
                    return response()->json(['success' => true, 'message' => 'Review screenshot removed successfully.']);
                }
                return redirect()->back()->with('t-success', 'Review screenshot removed successfully.');
            }

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Review not found.'], 404);
            }
            return redirect()->back()->with('t-error', 'Review not found.');
        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }
}
