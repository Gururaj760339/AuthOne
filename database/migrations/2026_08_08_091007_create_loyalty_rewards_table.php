<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loyalty_rewards', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->text('description')->nullable();

            $table->integer('points_required');

            // discount percentage
            $table->decimal('discount_percentage', 5, 2)
                ->nullable();

            // fixed discount amount
            $table->decimal('discount_amount', 12, 2)
                ->nullable();

            $table->string('coupon_code')
                ->unique()
                ->nullable();

            $table->integer('usage_limit')
                ->nullable();

            $table->integer('used_count')
                ->default(0);

            $table->date('expires_at')
                ->nullable();

            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loyalty_rewards');
    }
};