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

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Call seeders
        $this->call([
            UserSeeder::class,
            SystemSettingSeeder::class,
        ]);

    }
}
