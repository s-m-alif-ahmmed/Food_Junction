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
        Schema::create('offer_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();

            $table->enum('condition_type', [
                'min_quantity',
                'min_weight',
                'variant_id',
                'product_id',
                'cart_total'
            ]);

            $table->enum('operator', ['>=', '<=', '=', '>', '<', 'between'])->default('>=');

            // main value (like 500gm, 4pcs, etc.)
            $table->decimal('value', 10, 2)->nullable();

            // flexible JSON (unit, rules, bundle config etc.)
            $table->json('extra_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_conditions');
    }
};
