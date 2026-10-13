<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('baklava_offers', function (Blueprint $table) {
            if (!Schema::hasColumn('baklava_offers', 'collage_images')) {
                $table->json('collage_images')->nullable()->after('collage_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baklava_offers', function (Blueprint $table) {
            if (Schema::hasColumn('baklava_offers', 'collage_images')) {
                $table->dropColumn('collage_images');
            }
        });
    }
};
