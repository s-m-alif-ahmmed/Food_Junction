<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // SCENARIO 1: Global Cart % Discount — All Locations — Active
        // Tests: offer_type=discount, discount_type=percent, applies_to=cart
        // ============================================================
        $offer1 = Offer::updateOrCreate(
            ['name' => '10% Off Your Entire Order'],
            [
                'description'    => 'Get 10% off on any cart, any location. Always active.',
                'is_active'      => true,
                'priority'       => 10,
                'offer_type'     => 'discount',
                'discount_type'  => 'percent',
                'discount_value' => 10,
                'applies_to'     => 'cart',
                'location_scope' => 'all',
                'coupon_enabled' => false,
                'start_date'     => now()->subDays(10),
                'end_date'       => now()->addDays(30),
            ]
        );

        // ============================================================
        // SCENARIO 2: Fixed Amount Cart Discount — Dhaka Only — Active
        // Tests: offer_type=discount, discount_type=fixed, applies_to=cart, location_scope=dhaka
        // ============================================================
        $offer2 = Offer::updateOrCreate(
            ['name' => 'Tk 50 Off for Dhaka Customers'],
            [
                'description'    => 'Flat Tk 50 off for all Dhaka delivery orders.',
                'is_active'      => true,
                'priority'       => 5,
                'offer_type'     => 'discount',
                'discount_type'  => 'fixed',
                'discount_value' => 50,
                'applies_to'     => 'cart',
                'location_scope' => 'dhaka',
                'coupon_enabled' => false,
                'start_date'     => now()->subDays(5),
                'end_date'       => now()->addDays(20),
            ]
        );

        // ============================================================
        // SCENARIO 3: Free Delivery — Outside Dhaka — Active
        // Tests: offer_type=free_delivery, location_scope=outside
        // ============================================================
        $offer3 = Offer::updateOrCreate(
            ['name' => 'Free Delivery Outside Dhaka'],
            [
                'description'    => 'Enjoy free delivery on all orders outside Dhaka.',
                'is_active'      => true,
                'priority'       => 8,
                'offer_type'     => 'free_delivery',
                'discount_type'  => null,
                'discount_value' => null,
                'applies_to'     => 'cart',
                'location_scope' => 'outside',
                'coupon_enabled' => false,
                'start_date'     => now()->subDays(3),
                'end_date'       => now()->addDays(60),
            ]
        );

        // ============================================================
        // SCENARIO 4: Free Delivery — All Locations — Active
        // Tests: offer_type=free_delivery, location_scope=all
        // ============================================================
        $offer4 = Offer::updateOrCreate(
            ['name' => 'Free Delivery Weekend Special'],
            [
                'description'    => 'Free delivery everywhere this weekend.',
                'is_active'      => true,
                'priority'       => 9,
                'offer_type'     => 'free_delivery',
                'discount_type'  => null,
                'discount_value' => null,
                'applies_to'     => 'cart',
                'location_scope' => 'all',
                'coupon_enabled' => false,
                'start_date'     => now()->subDay(),
                'end_date'       => now()->addDays(2),
            ]
        );

        // ============================================================
        // SCENARIO 5: Product-Specific % Discount — Active
        // Tests: offer_type=discount, applies_to=product, discount_type=percent
        // Maps to: Roshmojuri and Kalo Jaam
        // ============================================================
        $offer5 = Offer::updateOrCreate(
            ['name' => '15% Off Selected Sweets'],
            [
                'description'    => 'Get 15% off on Roshmojuri and Kalo Jaam.',
                'is_active'      => true,
                'priority'       => 7,
                'offer_type'     => 'discount',
                'discount_type'  => 'percent',
                'discount_value' => 15,
                'applies_to'     => 'product',
                'location_scope' => 'all',
                'coupon_enabled' => false,
                'start_date'     => now()->subDays(2),
                'end_date'       => now()->addDays(14),
            ]
        );
        // Attach products
        $roshmojuri = Product::where('product_slug', 'roshmojuri')->first();
        $kaloJaam   = Product::where('product_slug', 'kalo-jaam')->first();
        $productIds = array_filter([
            $roshmojuri?->id,
            $kaloJaam?->id,
        ]);
        if (!empty($productIds)) {
            $offer5->products()->sync($productIds);
        }

        // ============================================================
        // SCENARIO 6: Product-Specific Fixed Discount — Dhaka Only — Active
        // Tests: offer_type=discount, applies_to=product, discount_type=fixed, location_scope=dhaka
        // Maps to: Mishti Doi and Pantua Box
        // ============================================================
        $offer6 = Offer::updateOrCreate(
            ['name' => 'Tk 20 Off on Packaged Items (Dhaka)'],
            [
                'description'    => 'Fixed Tk 20 discount on Mishti Doi and Pantua Box for Dhaka customers.',
                'is_active'      => true,
                'priority'       => 6,
                'offer_type'     => 'discount',
                'discount_type'  => 'fixed',
                'discount_value' => 20,
                'applies_to'     => 'product',
                'location_scope' => 'dhaka',
                'coupon_enabled' => false,
                'start_date'     => now()->subDays(1),
                'end_date'       => now()->addDays(10),
            ]
        );
        $mishtiDoi = Product::where('product_slug', 'mishti-doi-500g')->first();
        $pantuaBox = Product::where('product_slug', 'pantua-box-6pcs')->first();
        $productIds6 = array_filter([
            $mishtiDoi?->id,
            $pantuaBox?->id,
        ]);
        if (!empty($productIds6)) {
            $offer6->products()->sync($productIds6);
        }

        // ============================================================
        // SCENARIO 7: Coupon-Gated Offer (requires coupon to activate)
        // Tests: coupon_enabled=true — NOT auto-applied
        // ============================================================
        Offer::updateOrCreate(
            ['name' => 'VIP 20% Off (Coupon Required)'],
            [
                'description'    => 'Exclusive 20% off — only unlocked with a valid coupon code.',
                'is_active'      => true,
                'priority'       => 15,
                'offer_type'     => 'discount',
                'discount_type'  => 'percent',
                'discount_value' => 20,
                'applies_to'     => 'cart',
                'location_scope' => 'all',
                'coupon_enabled' => true, // NOT auto-applied; needs coupon
                'start_date'     => now()->subDays(5),
                'end_date'       => now()->addDays(30),
            ]
        );

        // ============================================================
        // SCENARIO 8: INACTIVE Offer (to test inactive filtering)
        // ============================================================
        Offer::updateOrCreate(
            ['name' => '[INACTIVE] Old Eid Discount'],
            [
                'description'    => 'This offer is no longer active.',
                'is_active'      => false,
                'priority'       => 1,
                'offer_type'     => 'discount',
                'discount_type'  => 'percent',
                'discount_value' => 25,
                'applies_to'     => 'cart',
                'location_scope' => 'all',
                'coupon_enabled' => false,
                'start_date'     => now()->subDays(30),
                'end_date'       => now()->subDays(5), // already expired
            ]
        );

        // ============================================================
        // SCENARIO 9: Future Offer (not yet started)
        // Tests: start_date in future — should NOT be applied yet
        // ============================================================
        Offer::updateOrCreate(
            ['name' => '[FUTURE] Summer Sale 30% Off'],
            [
                'description'    => 'Upcoming summer campaign — not yet active.',
                'is_active'      => true,
                'priority'       => 20,
                'offer_type'     => 'discount',
                'discount_type'  => 'percent',
                'discount_value' => 30,
                'applies_to'     => 'cart',
                'location_scope' => 'all',
                'coupon_enabled' => false,
                'start_date'     => now()->addDays(10), // future
                'end_date'       => now()->addDays(40),
            ]
        );
    }
}
