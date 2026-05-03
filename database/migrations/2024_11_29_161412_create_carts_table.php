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
                // 👤 User OR Guest
                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
                $table->string('session_id')->nullable(); // for guest users

                // 🎟️ Coupon (optional)
                $table->string('coupon_code')->nullable();

                // 📍 Delivery context (needed for offer engine)
                $table->enum('delivery_zone', ['dhaka', 'outside'])->nullable();

                // 💰 Calculated values (optional cache)
                $table->decimal('subtotal', 12, 2)->default(0);
                $table->decimal('discount', 12, 2)->default(0);
                $table->decimal('delivery_fee', 10, 2)->default(0);
                $table->decimal('total', 12, 2)->default(0);
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
