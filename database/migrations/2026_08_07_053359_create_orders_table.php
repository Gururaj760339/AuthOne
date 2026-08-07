<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Order identification
            $table->string('order_number')->unique();

            // Customer information
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');

            // Delivery address
            $table->text('shipping_address');
            $table->string('shipping_city')->nullable();
            $table->string('shipping_country')->default('UAE');

            // Order amount
            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);

            // Currency
            $table->string('currency', 3)->default('AED');

            // Payment
            $table->enum('payment_method', [
                'stripe',
                'paytabs',
                'sslcommerz',
                'aamarpay',
                'bkash',
                'nagad',
                'cash_on_delivery'
            ])->default('cash_on_delivery');

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'refunded'
            ])->default('pending');

            // Order status
            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->text('customer_note')->nullable();

            $table->timestamp('ordered_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};