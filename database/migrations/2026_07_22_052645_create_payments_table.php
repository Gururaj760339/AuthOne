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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('payment_for', [
                'finance',
                'rental',
                'import',
                'service'
            ]);

            $table->unsignedBigInteger('reference_id');

            $table->decimal('amount', 10, 2);

            $table->string('currency')->default('USD');

            $table->enum('payment_method', [
                'stripe',
                'paypal',
                'paytabs',
                'sslcommerz',
                'aamarpay',
                'bkash',
                'nagad',
                'cash',
            ]);

            $table->string('transaction_id')->nullable();

            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'refunded',
                'cancelled',
            ])->default('pending');

            $table->json('gateway_response')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
