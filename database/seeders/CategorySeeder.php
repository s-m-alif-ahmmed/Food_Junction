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
                'meta_title'       => 'Sweets',
                'meta_description' => 'Classic homemade Bengali sweets made fresh daily.',
                'meta_keywords'    => 'bengali sweets, roshmojuri, roshmalai, traditional',
                'name'             => 'Sweets',
                'category_slug'    => 'sweets',
                'status'           => 'active',
            ],
            [
                'meta_title'       => 'Premium Desserts',
                'meta_description' => 'Premium handcrafted sweets for every occasion.',
                'meta_keywords'    => 'premium desserts, gift desserts, special occasion',
                'name'             => 'Premium Desserts',
                'category_slug'    => 'premium-desserts',
                'status'           => 'active',
            ],
            // Product categories
            [
                'meta_title'       => 'Spicy Products',
                'meta_description' => 'Spicy Products',
                'meta_keywords'    => 'Spicy Products',
                'name'             => 'Spicy Products',
                'category_slug'    => 'spicy-products',
                'status'           => 'active',
            ],
            [
                'meta_title'       => 'Doi, Khirsha',
                'meta_description' => 'Doi, Khirsha',
                'meta_keywords'    => 'Doi, Khirsha',
                'name'             => 'Doi, Khirsha',
                'category_slug'    => 'doi-khirsha',
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
