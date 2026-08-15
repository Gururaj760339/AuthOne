<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loyalty_transactions', function (Blueprint $table) {

            $table->id();

            // User
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            // Points
            $table->integer('points');

            // Transaction Type
            $table->enum('type', [
                'earned',
                'redeemed',
                'bonus',
                'expired',
                'adjustment'
            ]);

            // Description
            $table->string('description')->nullable();

            // Reward
            $table->unsignedBigInteger('reward_id')->nullable();

            $table->foreign('reward_id')
                ->references('id')
                ->on('loyalty_rewards')
                ->nullOnDelete();

            // Order
            $table->unsignedBigInteger('order_id')->nullable();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loyalty_transactions');
    }
};