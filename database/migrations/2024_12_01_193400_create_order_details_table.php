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
        if (!Schema::hasTable('order_details')) {
            Schema::create('order_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();
                $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnDelete();
                // 📦 Product Snapshot (CRITICAL)
                $table->string('product_name'); // even if product deleted later

                // 💰 Pricing Snapshot
                $table->decimal('original_price', 10, 2)->nullable(); // before product discount
                $table->decimal('unit_price', 10, 2); // final price per unit

                $table->decimal('discount_amount', 10, 2)->default(0); // per item discount

                // 📏 Quantity System (Flexible for kg + pcs)
                $table->enum('unit_type', ['kg', 'pcs']);
                $table->decimal('unit_value', 10, 2)->nullable();
                // example:
                // kg → 0.5 (500gm), 1 (1kg)
                // pcs → 1, 5, 12

                $table->integer('quantity')->default(1);

                // 💵 Line Total
                $table->decimal('total_price', 12, 2);

                // 🧩 Extra Data (variant, SKU, etc.)
                $table->json('meta')->nullable();

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
        Schema::dropIfExists('order_details');
    }
};
