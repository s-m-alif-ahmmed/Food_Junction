<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Sweet categories
            [
                'meta_title'       => 'Traditional Bengali Sweets',
                'meta_description' => 'Classic homemade Bengali sweets made fresh daily.',
                'meta_keywords'    => 'bengali sweets, roshmojuri, roshmalai, traditional',
                'name'             => 'Sweet',
                'category_slug'    => 'sweet',
                'status'           => 'active',
            ],
            [
                'meta_title'       => 'Premium Sweets Collection',
                'meta_description' => 'Premium handcrafted sweets for every occasion.',
                'meta_keywords'    => 'premium sweets, gift sweets, special occasion',
                'name'             => 'Premium Sweet',
                'category_slug'    => 'premium-sweet',
                'status'           => 'active',
            ],
            // Product categories
            [
                'meta_title'       => 'Food Junction Products',
                'meta_description' => 'Packaged products available at Food Junction.',
                'meta_keywords'    => 'products, packaged food, beverages',
                'name'             => 'Product',
                'category_slug'    => 'product',
                'status'           => 'active',
            ],
            [
                'meta_title'       => 'Drinks & Beverages',
                'meta_description' => 'Refreshing drinks and beverages.',
                'meta_keywords'    => 'drinks, beverages, juice, cold drinks',
                'name'             => 'Beverage',
                'category_slug'    => 'beverage',
                'status'           => 'active',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['category_slug' => $data['category_slug']],
                $data
            );
        }
    }
}
