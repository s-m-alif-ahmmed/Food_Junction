<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('baklava_offers', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('slug')->nullable()->unique()->after('name');
            $table->unsignedBigInteger('product_id')->nullable()->after('slug');
            $table->unsignedBigInteger('variant_id')->nullable()->after('product_id');
        });

        // Update existing record if exists
        DB::table('baklava_offers')->whereNull('slug')->update([
            'name' => 'Baklava Special Offer',
            'slug' => 'baklava-offer',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baklava_offers', function (Blueprint $table) {
            $table->dropColumn(['name', 'slug', 'product_id', 'variant_id']);
        });
    }
};
