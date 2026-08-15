<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency', 10)->default('USD');

            // Membership duration
            $table->integer('duration_days')->default(30);

            // General discount
            $table->decimal('discount_percentage', 5, 2)->default(0);

            // Individual service discounts
            $table->decimal('roadside_discount', 5, 2)->default(0);
            $table->decimal('car_wash_discount', 5, 2)->default(0);
            $table->decimal('rental_discount', 5, 2)->default(0);

            // Benefits
            $table->boolean('priority_booking')->default(false);
            $table->boolean('free_inspection')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};