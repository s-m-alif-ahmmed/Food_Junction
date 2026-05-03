<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist
        $sweet      = Category::where('category_slug', 'sweet')->first();
        $premium    = Category::where('category_slug', 'premium-sweet')->first();
        $product    = Category::where('category_slug', 'product')->first();
        $beverage   = Category::where('category_slug', 'beverage')->first();

        $products = [
            // ============================
            // 🍬 Sweet Category (per kg)
            // ============================
            [
                'meta_title'        => 'Roshmojuri',
                'meta_description'  => 'Classic Roshmojuri sweet made from fresh milk.',
                'meta_keywords'     => 'roshmojuri, sweet',
                'category_id'       => $sweet?->id ?? 1,
                'name'              => 'Roshmojuri',
                'description'       => '<p>Classic Roshmojuri - a popular Bengali sweet.</p>',
                'image'             => null,
                'price'             => 950.00,
                'discount_price'    => 850.00,
                'product_type'      => 'Sweet',
                'product_slug'      => 'roshmojuri',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Roshmalai',
                'meta_description'  => 'Soft and spongy Roshmalai.',
                'meta_keywords'     => 'roshmalai, sweet',
                'category_id'       => $sweet?->id ?? 1,
                'name'              => 'Roshmalai',
                'description'       => '<p>Soft cottage cheese dumplings in cream sauce.</p>',
                'image'             => null,
                'price'             => 750.00,
                'discount_price'    => null,
                'product_type'      => 'Sweet',
                'product_slug'      => 'roshmalai',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Harivanga',
                'meta_description'  => 'Traditional Harivanga sweet.',
                'meta_keywords'     => 'harivanga, sweet',
                'category_id'       => $sweet?->id ?? 1,
                'name'              => 'হাঁড়ি ভাঙা',
                'description'       => '<p>Classic clay pot sweet - a heritage recipe.</p>',
                'image'             => null,
                'price'             => 1000.00,
                'discount_price'    => 850.00,
                'product_type'      => 'Sweet',
                'product_slug'      => 'harivanga',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Chomchom',
                'meta_description'  => 'Soft and juicy Chomchom sweet.',
                'meta_keywords'     => 'chomchom, sweet',
                'category_id'       => $sweet?->id ?? 1,
                'name'              => 'Chomchom',
                'description'       => '<p>Elongated milk-solid sweet soaked in sugar syrup.</p>',
                'image'             => null,
                'price'             => 800.00,
                'discount_price'    => null,
                'product_type'      => 'Sweet',
                'product_slug'      => 'chomchom',
                'status'            => 'active',
            ],

            // ============================
            // 🎁 Premium Sweet Category (per kg)
            // ============================
            [
                'meta_title'        => 'Kalo Jaam',
                'meta_description'  => 'Premium Kalo Jaam - dark milk fudge balls.',
                'meta_keywords'     => 'kalo jaam, gulab jamun, premium',
                'category_id'       => $premium?->id ?? 1,
                'name'              => 'Kalo Jaam',
                'description'       => '<p>Dark milk fudge balls, deep-fried and soaked in sugar syrup.</p>',
                'image'             => null,
                'price'             => 1200.00,
                'discount_price'    => 1100.00,
                'product_type'      => 'Sweet',
                'product_slug'      => 'kalo-jaam',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Sandesh',
                'meta_description'  => 'Premium Bengali Sandesh.',
                'meta_keywords'     => 'sandesh, premium sweet, bengali',
                'category_id'       => $premium?->id ?? 1,
                'name'              => 'Sandesh',
                'description'       => '<p>Soft Bengali sweet made from fresh paneer.</p>',
                'image'             => null,
                'price'             => 1400.00,
                'discount_price'    => null,
                'product_type'      => 'Sweet',
                'product_slug'      => 'sandesh',
                'status'            => 'active',
            ],

            // ============================
            // 📦 Product Category (per pcs)
            // ============================
            [
                'meta_title'        => 'Sweet Gift Box',
                'meta_description'  => 'Beautiful gift box with assorted sweets.',
                'meta_keywords'     => 'gift box, sweets, occasion',
                'category_id'       => $product?->id ?? 2,
                'name'              => 'Assorted Sweet Gift Box',
                'description'       => '<p>Beautifully packaged assorted sweets — perfect for gifting.</p>',
                'image'             => null,
                'price'             => 650.00,
                'discount_price'    => 600.00,
                'product_type'      => 'Product',
                'product_slug'      => 'assorted-sweet-gift-box',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Mishti Doi',
                'meta_description'  => 'Authentic Bengali sweet yogurt.',
                'meta_keywords'     => 'mishti doi, sweet yogurt, bengali',
                'category_id'       => $product?->id ?? 2,
                'name'              => 'Mishti Doi (500g pot)',
                'description'       => '<p>Authentic Bengali sweet yogurt set in a clay pot.</p>',
                'image'             => null,
                'price'             => 180.00,
                'discount_price'    => null,
                'product_type'      => 'Product',
                'product_slug'      => 'mishti-doi-500g',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Pantua Box',
                'meta_description'  => 'Ready-to-eat Pantua box.',
                'meta_keywords'     => 'pantua, sweet, box',
                'category_id'       => $product?->id ?? 2,
                'name'              => 'Pantua Box (6 pcs)',
                'description'       => '<p>Six pieces of soft fried milk fudge balls in syrup.</p>',
                'image'             => null,
                'price'             => 220.00,
                'discount_price'    => 200.00,
                'product_type'      => 'Product',
                'product_slug'      => 'pantua-box-6pcs',
                'status'            => 'active',
            ],

            // ============================
            // 🥤 Beverage Category (per pcs)
            // ============================
            [
                'meta_title'        => 'Fresh Mango Juice',
                'meta_description'  => 'Fresh seasonal mango juice.',
                'meta_keywords'     => 'mango juice, fresh juice, beverage',
                'category_id'       => $beverage?->id ?? 2,
                'name'              => 'Fresh Mango Juice (250ml)',
                'description'       => '<p>100% fresh mango juice, no preservatives.</p>',
                'image'             => null,
                'price'             => 80.00,
                'discount_price'    => 70.00,
                'product_type'      => 'Product',
                'product_slug'      => 'fresh-mango-juice-250ml',
                'status'            => 'active',
            ],
            [
                'meta_title'        => 'Lassi',
                'meta_description'  => 'Chilled sweet lassi drink.',
                'meta_keywords'     => 'lassi, yogurt drink, sweet lassi',
                'category_id'       => $beverage?->id ?? 2,
                'name'              => 'Sweet Lassi (300ml)',
                'description'       => '<p>Chilled, creamy sweet yogurt lassi.</p>',
                'image'             => null,
                'price'             => 90.00,
                'discount_price'    => null,
                'product_type'      => 'Product',
                'product_slug'      => 'sweet-lassi-300ml',
                'status'            => 'active',
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['product_slug' => $data['product_slug']],
                $data
            );
        }
    }
}
