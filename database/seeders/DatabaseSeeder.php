<?php

namespace Database\Seeders;

use Database\Seeders\SystemSettingSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    public function run(): void {

        // Disable foreign key checks to prevent issues with deletions
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        DB::table('users')->truncate(); // Clear users last
        DB::table('system_settings')->truncate();
        DB::table('home_bottom_banners')->truncate();
        DB::table('dynamic_pages')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Call seeders
        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
            HomeBottomBannerSeeder::class,
            DynamicPageSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

    }
}
