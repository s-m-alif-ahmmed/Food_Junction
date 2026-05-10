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
        Schema::create('delivery_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->enum('delivery_type', [
                'inside_dhaka',
                'outside_dhaka',
                'country'
            ]);

            $table->decimal('minimum_amount', 10, 2)
                ->default(0);

            $table->decimal('cost', 10, 2)
                ->default(0);

            $table->boolean('is_free')
                ->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_rules');
    }
};
