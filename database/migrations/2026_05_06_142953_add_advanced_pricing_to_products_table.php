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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('pricing_type', ['quantity', 'weight'])->default('quantity')->after('product_type');
            $table->json('pricing_variants')->nullable()->after('pricing_type');
            $table->json('location_conditions')->nullable()->after('pricing_variants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['pricing_type', 'pricing_variants', 'location_conditions']);
        });
    }
};
