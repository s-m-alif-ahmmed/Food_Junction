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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0);

            // free_delivery / discount
            $table->enum('offer_type', [
                'free_delivery',
                'free_product',
                'discount',
                'bundle_offer'
            ]);

            // fixed / percent (only for discount)
            $table->enum('discount_type', ['fixed', 'percent'])->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();

            // cart / product
            $table->enum('applies_to', ['cart', 'product'])->default('cart');

            // dhaka / outside / all
            $table->enum('location_scope', ['dhaka', 'outside', 'all'])->default('all');

            $table->boolean('coupon_enabled')->default(false);

            /*
            |--------------------------------------------------------------------------
            | Usage Limits
            |--------------------------------------------------------------------------
            */

            // Maximum total times this offer can be used
            $table->integer('max_total_usage')->nullable();

            // Already used total count
            $table->integer('used_total')->default(0);

            // Max usage per user
            $table->integer('max_usage_per_user')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Date Limits
            |--------------------------------------------------------------------------
            */

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
