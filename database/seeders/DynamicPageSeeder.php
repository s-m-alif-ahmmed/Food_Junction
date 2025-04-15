<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DynamicPageSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('dynamic_pages')->insert([
            [
                'id'                => 1,
                'page_title'        => 'Terms and conditions',
                'page_slug'         => 'terms-and-conditions',
                'page_content'      => 'Terms and conditions',
                'status'            => 'active',
                'created_at'        => '2024-09-05 04:06:22',
                'updated_at'        => '2024-09-05 10:07:59',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'page_title'        => 'Privacy Policy',
                'page_slug'         => 'privacy-policy',
                'page_content'      => 'Privacy Policy',
                'status'            => 'active',
                'created_at'        => '2024-09-05 04:06:22',
                'updated_at'        => '2024-09-05 10:07:59',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'page_title'        => 'Payment & Return Policy',
                'page_slug'         => 'payment-return-policy',
                'page_content'      => 'Payment & Return Policy',
                'status'            => 'active',
                'created_at'        => '2024-09-05 04:06:22',
                'updated_at'        => '2024-09-05 10:07:59',
                'deleted_at'        => null,
            ],
            [
                'id'                => 4,
                'page_title'        => 'Cookie Policy',
                'page_slug'         => 'cookie-policy',
                'page_content'      => 'Cookie Policy',
                'status'            => 'active',
                'created_at'        => '2024-09-05 04:06:22',
                'updated_at'        => '2024-09-05 10:07:59',
                'deleted_at'        => null,
            ],
        ]);
    }
}
