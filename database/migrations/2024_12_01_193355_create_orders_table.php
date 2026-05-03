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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade');
                // 👤 Customer Snapshot
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('number')->nullable();
                $table->string('whatsapp_number')->nullable();
                $table->text('address')->nullable();
                $table->text('note')->nullable();

                // 📍 Delivery Snapshot
                $table->enum('delivery_zone', ['dhaka', 'outside'])->nullable();
                $table->decimal('delivery_fee', 10, 2)->default(0);
                $table->boolean('is_free_delivery')->default(false);

                // 💸 Coupon Snapshot (IMPORTANT)
                $table->string('coupon_code')->nullable();
                $table->enum('coupon_type', ['fixed', 'percent'])->nullable();
                $table->decimal('coupon_value', 10, 2)->nullable();

                // 💰 Financial Snapshot (CRITICAL)
                $table->decimal('subtotal', 12, 2)->default(0);        // before any discount
                $table->decimal('product_discount', 12, 2)->default(0); // product-level discount
                $table->decimal('offer_discount', 12, 2)->default(0);   // offer engine discount
                $table->decimal('coupon_discount', 12, 2)->default(0);  // coupon discount

                $table->decimal('total_discount', 12, 2)->default(0);   // sum of all discounts
                $table->decimal('final_total', 12, 2)->default(0);      // payable

                // 🎯 Offer Snapshot (VERY IMPORTANT)
                $table->json('applied_offers')->nullable();
                $table->string('tracking_id')->nullable()->unique();
                $table->enum('all_terms',['yes','no'])->default('no');
                $table->enum('status',['pending','canceled','return','complete'])->default('pending');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
