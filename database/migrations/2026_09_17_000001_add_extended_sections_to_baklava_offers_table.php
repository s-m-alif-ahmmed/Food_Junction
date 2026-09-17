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
        Schema::table('baklava_offers', function (Blueprint $table) {
            // Problem Agitation Section
            $table->string('problem_title')->nullable()->after('video_url');
            $table->text('problem_subtitle')->nullable()->after('problem_title');
            $table->json('problem_cards')->nullable()->after('problem_subtitle');

            // Comparison Matrix Section
            $table->string('comparison_title')->nullable()->after('problem_cards');
            $table->text('comparison_subtitle')->nullable()->after('comparison_title');
            $table->string('comparison_bad_header')->nullable()->after('comparison_subtitle');
            $table->string('comparison_good_header')->nullable()->after('comparison_bad_header');
            $table->json('comparison_rows')->nullable()->after('comparison_good_header');

            // 3-Step Process & Highlights
            $table->string('step_section_title')->nullable()->after('comparison_rows');
            $table->text('step_section_subtitle')->nullable()->after('step_section_title');
            $table->json('feature_pills')->nullable()->after('step_section_subtitle');
            $table->json('process_steps')->nullable()->after('feature_pills');
            $table->json('checklist_items')->nullable()->after('process_steps');

            // Dual Benefits Section
            $table->string('dual_benefit_1_title')->nullable()->after('checklist_items');
            $table->text('dual_benefit_1_neg')->nullable()->after('dual_benefit_1_title');
            $table->text('dual_benefit_1_pos')->nullable()->after('dual_benefit_1_neg');
            $table->string('dual_benefit_2_title')->nullable()->after('dual_benefit_1_pos');
            $table->text('dual_benefit_2_neg')->nullable()->after('dual_benefit_2_title');
            $table->text('dual_benefit_2_pos')->nullable()->after('dual_benefit_2_neg');

            // Rating Statistics & Verified Testimonials
            $table->string('rating_score')->nullable()->after('reviews');
            $table->string('total_reviews_count')->nullable()->after('rating_score');
            $table->string('delivered_orders_text')->nullable()->after('total_reviews_count');
            $table->json('rating_breakdown')->nullable()->after('delivered_orders_text');
            $table->json('testimonials')->nullable()->after('rating_breakdown');

            // Countdown Timer & Socials
            $table->string('timer_badge')->default('অফার শেষ হতে বাকি')->after('outside_dhaka_delivery_fee');
            $table->dateTime('countdown_end_time')->nullable()->after('timer_badge');
            $table->string('facebook_url')->nullable()->after('whatsapp_number');
            $table->string('phone_number')->nullable()->after('facebook_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baklava_offers', function (Blueprint $table) {
            $table->dropColumn([
                'problem_title',
                'problem_subtitle',
                'problem_cards',
                'comparison_title',
                'comparison_subtitle',
                'comparison_bad_header',
                'comparison_good_header',
                'comparison_rows',
                'step_section_title',
                'step_section_subtitle',
                'feature_pills',
                'process_steps',
                'checklist_items',
                'dual_benefit_1_title',
                'dual_benefit_1_neg',
                'dual_benefit_1_pos',
                'dual_benefit_2_title',
                'dual_benefit_2_neg',
                'dual_benefit_2_pos',
                'rating_score',
                'total_reviews_count',
                'delivered_orders_text',
                'rating_breakdown',
                'testimonials',
                'timer_badge',
                'countdown_end_time',
                'facebook_url',
                'phone_number',
            ]);
        });
    }
};
