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
        if (!Schema::hasTable('carts')) {
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                /*
                |--------------------------------------------------------------------------
                | User / Guest
                |--------------------------------------------------------------------------
                */

                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnDelete();

                // For guest cart
                $table->string('session_id')
                    ->nullable()
                    ->index();

                /*
                |--------------------------------------------------------------------------
                | Coupon & Offer
                |--------------------------------------------------------------------------
                */

                $table->string('coupon_code')
                    ->nullable();

                $table->foreignId('offer_id')
                    ->nullable()
                    ->constrained()
                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Delivery Information
                |--------------------------------------------------------------------------
                */

                $table->string('delivery_zone')->nullable();

                $table->decimal('delivery_fee', 10, 2)
                    ->default(0);

                /*
                |--------------------------------------------------------------------------
                | Cart Calculations
                |--------------------------------------------------------------------------
                */

                // Product total before discount
                $table->decimal('subtotal', 12, 2)
                    ->default(0);

                // Automatic offer discount
                $table->decimal('offer_discount', 12, 2)
                    ->default(0);

                // Coupon discount
                $table->decimal('coupon_discount', 12, 2)
                    ->default(0);

                // Additional/manual discount
                $table->decimal('discount', 12, 2)
                    ->default(0);

                // Final payable amount
                $table->decimal('total', 12, 2)
                    ->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
