<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories that are already seeded by CategorySeeder
        $sweetsCategory = Category::where('category_slug', 'sweets')->first();
        $premiumCategory = Category::where('category_slug', 'premium-desserts')->first();
        $spicyCategory = Category::where('category_slug', 'spicy-products')->first();
        $doiCategory = Category::where('category_slug', 'doi-khirsha')->first();

        $products = [];

        // 1. Sweets Category Product
        if ($sweetsCategory) {
            $products[] = [
                'category_id' => $sweetsCategory->id,
                'name' => 'Traditional Roshmalai',
                'description' => 'Authentic Bengali Roshmalai made with pure milk and care.',
                'type' => 'gram',
                'product_slug' => 'traditional-roshmalai',
                'status' => 'active',
                'variants' => [
                    [
                        'variant_type' => 'gram',
                        'quantity' => 1000,
                        'unit' => 'gm',
                        'price' => 500.00,
                        'sale_price' => 480.00,
                        'stock' => 100,
                        'status' => 'Active',
                    ],
                    [
                        'variant_type' => 'gram',
                        'quantity' => 500,
                        'unit' => 'gm',
                        'price' => 260.00,
                        'sale_price' => 250.00,
                        'stock' => 200,
                        'status' => 'Active',
                    ]
                ]
            ];
        }

        // 2. Premium Desserts Category Product
        if ($premiumCategory) {
            $products[] = [
                'category_id' => $premiumCategory->id,
                'name' => 'Assorted Premium Gift Box',
                'description' => 'A perfect gift box containing a mix of our best premium sweets.',
                'type' => 'pcs',
                'product_slug' => 'assorted-premium-gift-box',
                'status' => 'active',
                'variants' => [
                    [
                        'variant_type' => 'pcs',
                        'quantity' => 1,
                        'unit' => 'pc',
                        'price' => 1200.00,
                        'sale_price' => 1100.00,
                        'stock' => 50,
                        'status' => 'Active',
                    ]
                ]
            ];
        }

        // 3. Spicy Products Category Product
        if ($spicyCategory) {
            $products[] = [
                'category_id' => $spicyCategory->id,
                'name' => 'Spicy Chana Mix',
                'description' => 'Crunchy and spicy mixed chana, perfect for evening snacks.',
                'type' => 'gram',
                'product_slug' => 'spicy-chana-mix',
                'status' => 'active',
                'variants' => [
                    [
                        'variant_type' => 'gram',
                        'quantity' => 250,
                        'unit' => 'gm',
                        'price' => 150.00,
                        'sale_price' => 150.00,
                        'stock' => 300,
                        'status' => 'Active',
                    ],
                    [
                        'variant_type' => 'gram',
                        'quantity' => 500,
                        'unit' => 'gm',
                        'price' => 280.00,
                        'sale_price' => 270.00,
                        'stock' => 150,
                        'status' => 'Active',
                    ]
                ]
            ];
        }

        // 4. Doi, Khirsha Category Product
        if ($doiCategory) {
            $products[] = [
                'category_id' => $doiCategory->id,
                'name' => 'Fresh Sweet Doi',
                'description' => 'Traditional sweet yogurt served in earthen pots.',
                'type' => 'pcs',
                'product_slug' => 'fresh-sweet-doi',
                'status' => 'active',
                'variants' => [
                    [
                        'variant_type' => 'pcs',
                        'quantity' => 1,
                        'unit' => 'pc', // Note: could be sold per pot (pc)
                        'price' => 250.00,
                        'sale_price' => 240.00,
                        'stock' => 80,
                        'status' => 'Active',
                    ]
                ]
            ];
        }

        // Insert Products and their Variants
        foreach ($products as $prodData) {
            $variants = $prodData['variants'];
            unset($prodData['variants']); // Remove variants array before creating product

            $product = Product::firstOrCreate(['product_slug' => $prodData['product_slug']], $prodData);
            
            // Create Variants for each product
            foreach ($variants as $variantData) {
                $variantData['product_id'] = $product->id;
                
                ProductVariant::firstOrCreate([
                    'product_id' => $product->id,
                    'variant_type' => $variantData['variant_type'],
                    'quantity' => $variantData['quantity'],
                    'unit' => $variantData['unit'],
                ], $variantData);
            }
        }
    }
}
