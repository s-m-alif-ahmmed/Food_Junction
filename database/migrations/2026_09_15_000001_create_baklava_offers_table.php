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
        Schema::create('baklava_offers', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('badge_text')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('offer_headline')->nullable();
            $table->text('offer_subtext')->nullable();
            $table->decimal('regular_price', 10, 2)->default(1850);
            $table->decimal('offer_price', 10, 2)->default(1350);
            $table->string('save_amount')->nullable();
            $table->text('video_url')->nullable();

            // Collage / Showcase Section
            $table->string('collage_image')->nullable();

            // Ingredients Section
            $table->string('ingredient_title')->nullable();
            $table->text('ingredient_subtitle')->nullable();
            $table->json('ingredients')->nullable();

            // Trust Badges
            $table->json('trust_badges')->nullable();

            // Reviews Section
            $table->string('reviews_title')->nullable();
            $table->text('reviews_subtitle')->nullable();
            $table->json('reviews')->nullable();

            // Story / Why We Made This Section
            $table->string('why_title')->nullable();
            $table->text('why_subtitle')->nullable();
            $table->string('why_heading')->nullable();
            $table->string('why_image')->nullable();
            $table->text('why_desc_1')->nullable();
            $table->text('why_desc_2')->nullable();

            // Guarantees
            $table->string('guarantee_1_title')->nullable();
            $table->text('guarantee_1_text')->nullable();
            $table->string('guarantee_2_title')->nullable();
            $table->text('guarantee_2_text')->nullable();

            // Order & Delivery Settings
            $table->string('package_title')->nullable();
            $table->string('package_subtitle')->nullable();
            $table->decimal('inside_dhaka_delivery_fee', 10, 2)->default(80);
            $table->decimal('outside_dhaka_delivery_fee', 10, 2)->default(150);
            $table->string('whatsapp_number')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baklava_offers');
    }
};
