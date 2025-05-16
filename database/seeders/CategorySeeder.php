<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'meta_title' => 'Roshmojuri',
                'meta_description' => 'Roshmojuri',
                'meta_keywords' => 'Roshmojuri',
                'name' => 'Sweet',
                'category_slug' => 'sweet',
                'status' => 'active',
            ],
            [
                'meta_title' => 'Roshmojuri',
                'meta_description' => 'Roshmojuri',
                'meta_keywords' => 'Roshmojuri',
                'name' => 'Product',
                'category_slug' => 'product',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $data) {
            Category::create([
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_keywords' => $data['meta_keywords'],
                'name' => $data['name'],
                'category_slug' => $data['category_slug'],
                'status' => $data['status'],
            ]);
        }
    }
}
