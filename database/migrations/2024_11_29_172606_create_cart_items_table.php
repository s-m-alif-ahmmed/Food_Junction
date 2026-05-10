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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relations
            |--------------------------------------------------------------------------
            */

            $table->foreignId('cart_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('variant_id')
                ->nullable()
                ->constrained('product_variants')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Package Support
            |--------------------------------------------------------------------------
            */

            // If user adds combo/package
            $table->foreignId('package_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Product Type
            |--------------------------------------------------------------------------
            */

            $table->enum('item_type', [
                'product',
                'package',
                'free_product'
            ])->default('product');

            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */

            // Example:
            // 1 = one package
            // 2 = two packages
            // 3 = three pcs
            $table->integer('quantity')
                ->default(1);

            /*
            |--------------------------------------------------------------------------
            | Variant Snapshot
            |--------------------------------------------------------------------------
            */

            // Snapshot for order consistency
            $table->string('variant_name')
                ->nullable();

            // pc / gm
            $table->string('unit')
                ->nullable();

            // 4 / 8 / 500 / 1000
            $table->decimal('variant_quantity', 10, 2)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Pricing Snapshot
            |--------------------------------------------------------------------------
            */

            // Single item price
            $table->decimal('unit_price', 10, 2)
                ->default(0);

            // Before discount
            $table->decimal('subtotal', 12, 2)
                ->default(0);

            // Item-level discount
            $table->decimal('discount', 12, 2)
                ->default(0);

            // Final total
            $table->decimal('total', 12, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Offer Information
            |--------------------------------------------------------------------------
            */

            // If item came from offer/gift
            $table->foreignId('offer_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->boolean('is_free')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Extra Data
            |--------------------------------------------------------------------------
            */

            $table->json('meta')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
