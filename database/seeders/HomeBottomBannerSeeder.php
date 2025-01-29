<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeBottomBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_bottom_banners')->insert([
            'id'             => 1,
            'title'          => null,
            'image'          => null,
            'created_at'     => Carbon::parse('2025-01-29 23:17:03'),
            'updated_at'     => Carbon::parse('2025-01-29 23:25:01'),
        ]);
    }
}
