<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaklavaOffer extends Model
{
    use HasFactory;

    protected $table = 'baklava_offers';

    protected $guarded = ['id'];

    protected $casts = [
        'ingredients'       => 'array',
        'trust_badges'      => 'array',
        'reviews'           => 'array',
        'problem_cards'     => 'array',
        'comparison_rows'   => 'array',
        'feature_pills'     => 'array',
        'process_steps'     => 'array',
        'checklist_items'   => 'array',
        'rating_breakdown'  => 'array',
        'testimonials'      => 'array',
        'countdown_end_time'=> 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public static function getDefaultIngredients(): array
    {
        return [
            ['name' => 'দেশী গাওয়া ঘি', 'image' => 'frontend/images/landing/baklava/ing_ghee.jpg'],
            ['name' => 'প্রিমিয়াম পেস্তা', 'image' => 'frontend/images/landing/baklava/ing_pista.jpg'],
            ['name' => 'জাম্বু কাজু', 'image' => 'frontend/images/landing/baklava/ing_kaju.jpg'],
            ['name' => 'প্রাকৃতিক মধু', 'image' => 'frontend/images/landing/baklava/ing_honey.jpg'],
            ['name' => 'প্রিমিয়াম ফ্লাওয়ার', 'image' => 'frontend/images/landing/baklava/ing_flour.jpg'],
        ];
    }

    public static function getDefaultTrustBadges(): array
    {
        return [
            ['title' => '১০০% খাঁটি গাওয়া ঘি', 'subtitle' => 'খাঁটি উপাদানের নিশ্চয়তা', 'icon' => 'fa-solid fa-shield-halved'],
            ['title' => 'চেক করে মূল্য পরিশোধ', 'subtitle' => 'ক্যাশ অন ডেলিভারি', 'icon' => 'fa-solid fa-hand-holding-dollar'],
            ['title' => '৫,০০০+ সন্তুষ্ট কাস্টমার', 'subtitle' => 'সারা বাংলাদেশে ডেলিভারি', 'icon' => 'fa-solid fa-award'],
        ];
    }

    public static function getDefaultProblemCards(): array
    {
        return [
            [
                'title' => 'খাঁটি স্বাদের অভাব?',
                'desc'  => 'বাজারের অধিকাংশ মিষ্টিতে ব্যবহৃত হয় কৃত্রিম ফ্লেভার ও নিম্নমানের ডালডা!',
                'icon'  => 'fa-solid fa-triangle-exclamation',
            ],
            [
                'title' => 'অতিরিক্ত কড়া মিষ্টি?',
                'desc'  => 'অরিজিনাল তুর্কি রেসিপি না হওয়ায় চিনির কড়া শিরায় বাকলাভার আসল ক্রাঞ্চ নষ্ট হয়!',
                'icon'  => 'fa-solid fa-candy-cane',
            ],
            [
                'title' => 'সাধারণ প্যাকেজিং?',
                'desc'  => 'উপহার দেওয়ার মতো মানসম্মত ও স্বাস্থ্যসম্মত এয়ারটাইট প্রিমিয়াম বক্স পাওয়া যায় না!',
                'icon'  => 'fa-solid fa-box-archive',
            ],
        ];
    }

    public static function getDefaultComparisonRows(): array
    {
        return [
            ['label' => '১. উপাদানের মান', 'bad' => 'সাধারণ ডালডা বা পাম অয়েল', 'good' => '১০০% খাঁটি দেশি গাওয়া ঘি'],
            ['label' => '২. বাদামের পরিমাণ', 'bad' => 'নামমাত্র নিম্নমানের বাদাম', 'good' => 'প্রচুর প্রিমিয়াম পেস্তা ও কাজু'],
            ['label' => '৩. ক্রিস্পিনেস ও লেয়ার', 'bad' => 'নরম বা অতিরিক্ত চ্যাটচ্যাটে', 'good' => '৪০+ মুচমুচে পাতলা ফিলো লেয়ার'],
            ['label' => '৪. মিষ্টির মাত্রা', 'bad' => 'অতিরিক্ত কড়া চিনির শিরা', 'good' => 'প্রাকৃতিক মধু ও ব্যালান্সড মিষ্টতা'],
            ['label' => '৫. উপহার ও প্যাকেজিং', 'bad' => 'সাধারণ কাগজের নরম বক্স', 'good' => 'রাজকীয় প্রিমিয়াম গিফট বক্স'],
            ['label' => '৬. স্পেশাল অফার', 'bad' => 'কোনো ফ্রী আইটেম নেই', 'good' => 'হাফকেজি পেরা সন্দেশ সম্পূর্ণ ফ্রি!'],
        ];
    }

    public static function getDefaultFeaturePills(): array
    {
        return [
            '১০০% খাঁটি গাওয়া ঘি',
            'প্রিমিয়াম পেস্তা ও কাজু',
            'প্রাকৃতিক মধু',
            'এয়ারটাইট সিল প্যাক',
        ];
    }

    public static function getDefaultProcessSteps(): array
    {
        return [
            [
                'num'   => '০১',
                'title' => 'খাঁটি উপাদানের মেলবন্ধন',
                'desc'  => 'দেশি গাওয়া ঘি, জাম্বু কাজু ও পেস্তা বাদামের নিখুঁত সংমিশ্রণ — কোনো কেমিক্যাল বা প্রিজারভেটিভ নেই।',
                'icon'  => 'fa-solid fa-wand-magic-sparkles',
            ],
            [
                'num'   => '০২',
                'title' => '৪০+ মুচমুচে লেয়ার',
                'desc'  => 'তুর্কি ওস্তাদদের খাঁটি কারিগরিতে তৈরি পারফেক্ট মুচমুচে ফিলো পেস্ট্রি যা মুখে দিলেই গলে যায়।',
                'icon'  => 'fa-solid fa-layer-group',
            ],
            [
                'num'   => '০৩',
                'title' => 'হাফ কেজি পেরা সন্দেশ ফ্রি',
                'desc'  => 'পাবনার শতাব্দী প্রাচীন খাঁটি ক্ষীরের তৈরি বিখ্যাত পেরা সন্দেশ সম্পূর্ণ ফ্রিতে প্যাকেজে অন্তর্ভুক্ত।',
                'icon'  => 'fa-solid fa-gift',
            ],
        ];
    }

    public static function getDefaultChecklistItems(): array
    {
        return [
            'কোনো কৃত্রিম রঙ বা ক্ষতিকর উপাদান নেই',
            '১০০% হাইজেনিক ও নিরাপদ সিল প্যাকেজিং',
            'ক্যাশ অন ডেলিভারি — চেক করে মূল্য পরিশোধ',
        ];
    }

    public static function getDefaultRatingBreakdown(): array
    {
        return [
            ['star' => 5, 'percent' => 88],
            ['star' => 4, 'percent' => 10],
            ['star' => 3, 'percent' => 2],
            ['star' => 2, 'percent' => 0],
            ['star' => 1, 'percent' => 0],
        ];
    }

    public static function getDefaultTestimonials(): array
    {
        return [
            [
                'name'           => 'রাকিব হাসান',
                'location'       => 'ঢাকা',
                'avatar_letter'  => 'র',
                'stars'          => 5,
                'text'           => 'বাকলাভাটা অসম্ভব ক্রিস্পি ও পারফেক্ট মিষ্টি। সাথে পেরা সন্দেশের ক্ষীরের স্বাদটা ছিল একদম অথেন্টিক!',
            ],
            [
                'name'           => 'সাদমান ইসলাম',
                'location'       => 'চট্টগ্রাম',
                'avatar_letter'  => 'স',
                'stars'          => 5,
                'text'           => 'গিফট বক্সের প্যাকেজিং দেখে সবাই অবাক! ঘিয়ের সুন্দর সুবাস আর বাদামের ক্রাঞ্চ দারুণ লেগেছে।',
            ],
            [
                'name'           => 'তানভীর আহমেদ',
                'location'       => 'সিলেট',
                'avatar_letter'  => 'ত',
                'stars'          => 5,
                'text'           => 'অর্ডারের ২ দিনের মধ্যে হাতে পেয়েছি। ক্যাশ অন ডেলিভারিতে চেক করে নিতে পেরে নিশ্চিন্ত লাগলো।',
            ],
        ];
    }

    public static function getDefaultReviews(): array
    {
        $reviews = [];
        for ($i = 1; $i <= 15; $i++) {
            $reviews[] = "frontend/images/landing/baklava/review_{$i}.jpg";
        }
        return $reviews;
    }

    /**
     * Get or create the default settings row with pre-populated defaults.
     */
    public static function getSettings(): self
    {
        $settings = self::where('slug', 'baklava-offer')->first() ?? self::first();

        if (!$settings) {
            $settings = self::create([
                'name'                       => 'Baklava Special Offer',
                'slug'                       => 'baklava-offer',
                'badge_text'                 => '★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★',
                'hero_title'                 => 'Premium Turkish Dessert, now at your home.',
                'hero_image'                 => 'frontend/images/landing/baklava/hero_tray.png',
                'offer_headline'             => '২০ পিস বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!',
                'offer_subtext'              => 'তুরস্কের অথেন্টিক এবং গ্রাম বাংলার ঐতিহ্যবাহী ১০০% খাঁটি স্বাদ — সবচেয়ে নরম ও মুচমুচে স্বাদে সেরা',
                'regular_price'              => 1850,
                'offer_price'                => 1350,
                'save_amount'                => '৫০০ টাকা ছাড়',
                'video_url'                  => 'https://a.dropoverapp.com/cloud/download/575a33ff-da66-46f2-8e71-dd19d025fbb2/5857a7ac-694d-4690-9bf5-fb320cb99295',
                'problem_title'              => 'আপনার কি মিষ্টি কিনতে এই সমস্যাগুলো হয়?',
                'problem_subtitle'           => 'কেন সাধারণ মিষ্টি নয়, এখনই সঠিক সিদ্ধান্ত নেবেন',
                'problem_cards'              => self::getDefaultProblemCards(),
                'comparison_title'           => 'সাধারণ মিষ্টি বা বাকলাভা কেন সমাধান নয়?',
                'comparison_subtitle'        => 'Food Junction এর প্রিমিয়াম প্যাকেজ কেন অন্যদের চেয়ে সম্পূর্ণ আলাদা ও অনন্য',
                'comparison_bad_header'      => 'সাধারণ রেগুলার মিষ্টি',
                'comparison_good_header'     => 'Food Junction বাকলাভা',
                'comparison_rows'            => self::getDefaultComparisonRows(),
                'step_section_title'         => '৩০ সেকেন্ডে মুগ্ধ হবেন সেরা স্বাদে',
                'step_section_subtitle'      => 'খাঁটি স্বাদ ও রাজকীয় আভিজাত্য — প্রতিটি কামড়ে তুর্কি ঐতিহ্যের অনন্য অনুভূতি',
                'feature_pills'              => self::getDefaultFeaturePills(),
                'process_steps'              => self::getDefaultProcessSteps(),
                'checklist_items'            => self::getDefaultChecklistItems(),
                'dual_benefit_1_title'       => 'টার্কিশ বাকলাভা',
                'dual_benefit_1_neg'         => 'সাধারণ মিষ্টির মতো অতিরিক্ত কড়া বা ভারী লাগে না',
                'dual_benefit_1_pos'         => 'পেস্তা-কাজুর মুচমুচে ক্রাঞ্চ ও খাঁটি ঘৃত সুবাসে ভরপুর',
                'dual_benefit_2_title'       => 'পাবনার পেরা সন্দেশ',
                'dual_benefit_2_neg'         => 'বাজারে পাউডার দুধের কৃত্রিম ক্ষীর নয়',
                'dual_benefit_2_pos'         => 'খাঁটি তরল দুধ ঘণ্টার পর ঘণ্টা জ্বাল দিয়ে তৈরি শতাব্দী প্রাচীন ঐতিহ্য',
                'rating_score'               => '৪.৯',
                'total_reviews_count'        => '৫,২৩০+ রিভিউ',
                'delivered_orders_text'      => 'সারা বাংলাদেশে ৬,০০০+ সফল ডেলিভার্ড অর্ডার',
                'rating_breakdown'           => self::getDefaultRatingBreakdown(),
                'testimonials'               => self::getDefaultTestimonials(),
                'timer_badge'                => 'অফার শেষ হতে বাকি',
                'countdown_end_time'         => null,
                'facebook_url'               => 'https://www.facebook.com',
                'phone_number'               => '8801672756634',
                'collage_image'              => 'frontend/images/landing/baklava/collage_box.jpg',
                'ingredient_title'           => '১০০% খাঁটি ও সেরা উপাদানসমূহ',
                'ingredient_subtitle'        => 'আমাদের প্রতিটি মিষ্টি প্রস্তুত হয় প্রাকৃতিক ও হাইজেনিক উপাদান দিয়ে',
                'ingredients'                => self::getDefaultIngredients(),
                'trust_badges'               => self::getDefaultTrustBadges(),
                'reviews_title'              => 'বাস্তব গ্রাহকদের পাঠানো রিভিউসমূহ',
                'reviews_subtitle'           => 'ছবিতে ট্যাপ করে বড় করে দেখুন',
                'reviews'                    => self::getDefaultReviews(),
                'why_title'                  => 'Why We Made This?',
                'why_subtitle'               => 'Food Junction এ আমরা বিশ্বাস করি প্রতিটি মিষ্টির সাথে জড়িয়ে থাকে ভালোবাসার গল্প',
                'why_heading'                => 'Delivery All Over Bangladesh',
                'why_image'                  => 'frontend/images/landing/baklava/why_platter.jpg',
                'why_desc_1'                 => 'From Dhaka to every district — each box is packed fresh, sealed by hand and couriered straight to your door.',
                'why_desc_2'                 => 'তুর্কি ঐতিহ্যবাহী মুচমুচে পেস্তা-কাজু সমৃদ্ধ বাকলাভা এবং গ্রাম বাংলার শতাব্দীর সেরা খাঁটি পাবনার পেরা সন্দেশ—দুটি অনন্য স্বাদের মেলবন্ধন ঘটাতে আমাদের এই বিশেষ প্যাকেজটি তৈরি করা হয়েছে।',
                'guarantee_1_title'          => 'Cash On Delivery Available',
                'guarantee_1_text'           => 'পণ্য হাতে পেয়ে চেক করে মূল্য পরিশোধ করুন',
                'guarantee_2_title'          => '100% Secure Packaging',
                'guarantee_2_text'           => 'নিরাপদ ও স্বাস্থ্যসম্মত ভ্যাকুয়াম সিল প্যাকেজিং',
                'package_title'              => '২০ পিস টার্কিশ বাকলাভা + হাফকেজি পাবনার পেরা সন্দেশ (ফ্রী)',
                'package_subtitle'           => 'সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ',
                'inside_dhaka_delivery_fee'  => 80,
                'outside_dhaka_delivery_fee' => 150,
                'whatsapp_number'            => '8801672756634',
                'status'                     => 'active',
            ]);
        }

        return $settings;
    }
}
