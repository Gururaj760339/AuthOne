<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            // Add subscription to payment_for enum
            $table->enum('payment_for', [
                'finance',
                'rental',
                'import',
                'service',
                'warranty_extended',
                'spare_part',
                'subscription',
            ])->change();

            // VIP discount amount/percentage
            $table->decimal('vip_discount', 10, 2)
                ->default(0)
                ->after('amount');

            // Final payable amount after discount
            $table->decimal('final_amount', 10, 2)
                ->default(0)
                ->after('vip_discount');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->enum('payment_for', [
                'finance',
                'rental',
                'import',
                'service',
                'warranty_extended',
                'spare_part',
            ])->change();

            $table->dropColumn([
                'vip_discount',
                'final_amount',
            ]);
        });
    }
};