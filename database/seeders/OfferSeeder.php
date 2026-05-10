<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\OfferCondition;
use App\Models\OfferReward;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a Global "Free Delivery Over 1000" Offer
        $offer1 = Offer::firstOrCreate(['name' => 'Free Delivery Over 1000 BDT'], [
            'description' => 'Get free delivery inside Dhaka for orders over 1000 BDT.',
            'is_active' => true,
            'offer_type' => 'free_delivery',
            'applies_to' => 'cart',
            'location_scope' => 'dhaka',
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
        ]);

        if ($offer1->wasRecentlyCreated) {
            OfferCondition::create([
                'offer_id' => $offer1->id,
                'condition_type' => 'cart_total',
                'operator' => '>=',
                'value' => 1000.00,
            ]);

            OfferReward::create([
                'offer_id' => $offer1->id,
                'reward_type' => 'free_delivery_inside_dhaka',
            ]);
        }

        // 2. Create a "10% Discount on Roshmalai" Product-specific Offer
        $sweetProduct = Product::where('product_slug', 'traditional-roshmalai')->first();
        
        if ($sweetProduct) {
            $offer2 = Offer::firstOrCreate(['name' => '10% Off on Traditional Roshmalai'], [
                'description' => 'Enjoy a 10% discount on Traditional Roshmalai.',
                'is_active' => true,
                'offer_type' => 'discount',
                'discount_type' => 'percent',
                'discount_value' => 10.00,
                'applies_to' => 'product',
                'location_scope' => 'all',
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
            ]);

            if ($offer2->wasRecentlyCreated) {
                OfferCondition::create([
                    'offer_id' => $offer2->id,
                    'condition_type' => 'product_id',
                    'operator' => '=',
                    'value' => $sweetProduct->id,
                ]);

                OfferReward::create([
                    'offer_id' => $offer2->id,
                    'reward_type' => 'discount_percent',
                    'product_id' => $sweetProduct->id,
                    'discount_value' => 10.00,
                ]);
            }
        }
    }
}
