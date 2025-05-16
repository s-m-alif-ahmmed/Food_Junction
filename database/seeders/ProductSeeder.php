<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'meta_title' => 'Roshmojuri',
                'meta_description' => 'Roshmojuri',
                'meta_keywords' => 'Roshmojuri',
                'category_id' => 1,
                'name' => 'Roshmojuri ',
                'description' => null,
                'image' => null,
                'price' => 950.00,
                'discount_price' => 850.00,
                'product_type' => 'Sweet',
                'product_slug' => 'roshmojuri',
                'status' => 'active',
            ],
            [
                'meta_title' => 'Roshmalai',
                'meta_description' => 'Roshmalai',
                'meta_keywords' => 'Roshmalai',
                'category_id' => 1,
                'name' => 'Roshmalai',
                'description' => null,
                'image' => null,
                'price' => 750.00,
                'discount_price' => null,
                'product_type' => 'Sweet',
                'product_slug' => 'roshmalai',
                'status' => 'active',
            ],
            [
                'meta_title' => 'Harivanga',
                'meta_description' => 'Harivanga',
                'meta_keywords' => 'Harivanga',
                'category_id' => 1,
                'name' => 'হাঁড়ি ভাঙা ',
                'description' => null,
                'image' => null,
                'price' => 1000.00,
                'discount_price' => 850.00,
                'product_type' => 'Sweet',
                'product_slug' => 'harivanga',
                'status' => 'active',
            ]
        ];

        foreach ($products as $data) {
            Product::create([
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_keywords' => $data['meta_keywords'],
                'category_id' => $data['category_id'],
                'name' => $data['name'],
                'description' => $data['description'],
                'image' => $data['image'],
                'price' => $data['price'],
                'discount_price' => $data['discount_price'],
                'product_type' => $data['product_type'],
                'product_slug' => $data['product_slug'],
                'status' => $data['status'],
            ]);
        }
    }
}
