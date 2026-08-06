<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('import_requests', function (Blueprint $table) {

            $table->string('shippo_shipment_id')->nullable();

            $table->string('tracking_number')->nullable();

            $table->string('tracking_status')->nullable();

            $table->decimal('shipping_cost',10,2)->nullable();

            $table->string('currency')->default('USD');

            $table->timestamp('estimated_delivery')->nullable();

            $table->string('customs_status')->default('Pending');

        });
    }

    public function down(): void
    {
        Schema::table('import_requests', function (Blueprint $table) {

            $table->dropColumn([
                'shippo_shipment_id',
                'tracking_number',
                'tracking_status',
                'shipping_cost',
                'currency',
                'estimated_delivery',
                'customs_status',
            ]);

        });
    }
};