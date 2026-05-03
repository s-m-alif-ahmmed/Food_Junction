<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            // ============================================================
            // SCENARIO 1: Percentage Coupon — Active, No Expiry
            // Tests: type=percent, no expires_at, unlimited uses
            // ============================================================
            [
                'code'          => 'SAVE10',
                'name'          => '10% Off Coupon',
                'type'          => 'percent',
                'discount_amount' => 10, // 10%
                'min_amount'    => 0,
                'max_uses'      => null, // unlimited
                'max_uses_user' => null, // unlimited per user
                'starts_at'     => now()->subDays(10),
                'expires_at'    => null, // never expires
                'status'        => 'active',
            ],

            // ============================================================
            // SCENARIO 2: Fixed Amount Coupon — Active, Expires in 7 days
            // Tests: type=fixed, expires_at set
            // ============================================================
            [
                'code'          => 'FLAT100',
                'name'          => 'Flat Tk 100 Off',
                'type'          => 'fixed',
                'discount_amount' => 100, // Tk 100
                'min_amount'    => 500, // only if cart >= 500
                'max_uses'      => 50,
                'max_uses_user' => 1,
                'starts_at'     => now()->subDays(2),
                'expires_at'    => now()->addDays(7),
                'status'        => 'active',
            ],

            // ============================================================
            // SCENARIO 3: High % Coupon — Active, Short Expiry (flash sale)
            // Tests: big discount, very short window
            // ============================================================
            [
                'code'          => 'FLASH25',
                'name'          => '25% Flash Sale Coupon',
                'type'          => 'percent',
                'discount_amount' => 25, // 25%
                'min_amount'    => 300,
                'max_uses'      => 20,
                'max_uses_user' => 1,
                'starts_at'     => now()->subHours(2),
                'expires_at'    => now()->addHours(22), // expires in 22 hours
                'status'        => 'active',
            ],

            // ============================================================
            // SCENARIO 4: VIP Coupon — Active, Pairs with Coupon-Gated Offer
            // Tests: coupon_enabled=true offer unlocking
            // ============================================================
            [
                'code'          => 'VIP2026',
                'name'          => 'VIP Member 20% Discount',
                'type'          => 'percent',
                'discount_amount' => 20, // 20%
                'min_amount'    => 0,
                'max_uses'      => 100,
                'max_uses_user' => 2,
                'starts_at'     => now()->subDays(5),
                'expires_at'    => now()->addDays(30),
                'status'        => 'active',
            ],

            // ============================================================
            // SCENARIO 5: EXPIRED Coupon — Should be rejected
            // Tests: expired coupon code validation
            // ============================================================
            [
                'code'          => 'EXPIRED50',
                'name'          => 'Old 50% Coupon (Expired)',
                'type'          => 'percent',
                'discount_amount' => 50,
                'min_amount'    => 0,
                'max_uses'      => null,
                'max_uses_user' => null,
                'starts_at'     => now()->subDays(30),
                'expires_at'    => now()->subDays(5), // already expired
                'status'        => 'active',
            ],

            // ============================================================
            // SCENARIO 6: INACTIVE Coupon — Should be rejected even if not expired
            // Tests: status=inactive validation
            // ============================================================
            [
                'code'          => 'DISABLED',
                'name'          => 'Disabled Coupon',
                'type'          => 'fixed',
                'discount_amount' => 200,
                'min_amount'    => 0,
                'max_uses'      => null,
                'max_uses_user' => null,
                'starts_at'     => now()->subDays(10),
                'expires_at'    => now()->addDays(10),
                'status'        => 'inactive', // disabled
            ],

            // ============================================================
            // SCENARIO 7: Fixed High Value Coupon — Free shipping + big discount test
            // Tests: large fixed coupon, checks total doesn't go negative
            // ============================================================
            [
                'code'          => 'BIGSAVE',
                'name'          => 'Big Saver Tk 500 Off',
                'type'          => 'fixed',
                'discount_amount' => 500,
                'min_amount'    => 1000, // cart must be >= 1000
                'max_uses'      => 10,
                'max_uses_user' => 1,
                'starts_at'     => now()->subDay(),
                'expires_at'    => now()->addDays(15),
                'status'        => 'active',
            ],
        ];

        foreach ($coupons as $data) {
            Coupon::updateOrCreate(
                ['code' => $data['code']],
                $data
            );
        }
    }
}
