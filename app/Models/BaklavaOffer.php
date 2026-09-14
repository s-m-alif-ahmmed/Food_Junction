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
        'ingredients'  => 'array',
        'trust_badges' => 'array',
        'reviews'      => 'array',
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
            ['title' => 'Handmade in Bangladesh', 'subtitle' => 'সম্পূর্ণ হাতে তৈরি ফ্রেশ', 'icon' => 'fa-hands-holding'],
            ['title' => 'Premium Gift Packaging', 'subtitle' => 'আকর্ষণীয় গিফট বক্স ফ্রি', 'icon' => 'fa-gift'],
            ['title' => 'Carefully Finished by Hand', 'subtitle' => 'নিখুঁত ও হাইজেনিক ফিনিশ', 'icon' => 'fa-medal'],
            ['title' => 'Nationwide Delivery', 'subtitle' => 'সারাদেশে হোম ডেলিভারি', 'icon' => 'fa-truck-fast'],
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
                'offer_subtext'              => 'তুরস্কের অথেন্টিক এবং গ্রাম বাংলার ঐতিহ্যবাহী স্বাদ এখন একসাথে',
                'regular_price'              => 1850,
                'offer_price'                => 1350,
                'save_amount'                => '৫০০ টাকা ছাড়',
                'video_url'                  => 'https://a.dropoverapp.com/cloud/download/575a33ff-da66-46f2-8e71-dd19d025fbb2/5857a7ac-694d-4690-9bf5-fb320cb99295',
                'collage_image'              => 'frontend/images/landing/baklava/collage_box.jpg',
                'ingredient_title'           => 'INGREDIENTS',
                'ingredient_subtitle'        => 'আমাদের প্রতিটি বাকলাভা প্রস্তুত হয় সেরা ও প্রাকৃতিক উপাদান দিয়ে',
                'ingredients'                => self::getDefaultIngredients(),
                'trust_badges'               => self::getDefaultTrustBadges(),
                'reviews_title'              => 'Trusted by 5000+ Happy Customers',
                'reviews_subtitle'           => 'আমাদের নিয়মিত গ্রাহকদের পাঠানো বাস্তব রিভিউ স্ক্রিনশটসমূহ',
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
