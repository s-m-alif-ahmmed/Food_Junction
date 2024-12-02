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
                $table->integer('delivery_fee')->nullable();
                $table->integer('discount_amount')->nullable();
                $table->integer('login_discount')->nullable();
                $table->integer('estimate_total')->nullable();
                $table->integer('order_total')->nullable();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('number')->nullable();
                $table->string('whatsapp_number')->nullable();
                $table->string('address')->nullable();
                $table->string('note')->nullable();
                $table->enum('all_terms',['yes','no'])->default('no');
                $table->string('tracking_id')->nullable();
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
