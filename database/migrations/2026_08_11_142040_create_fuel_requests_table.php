<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fuel_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('fuel_partner_id')
                ->nullable()
                ->constrained('fuel_partners')
                ->nullOnDelete();

            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('fuel_partner_drivers')
                ->nullOnDelete();

            $table->enum('fuel_type', [
                'petrol_91',
                'petrol_95',
                'petrol_98',
                'diesel'
            ]);

            $table->decimal('requested_quantity', 8, 2);
            $table->decimal('delivered_quantity', 8, 2)->nullable();

            $table->decimal('fuel_price', 10, 2)->default(0);
            $table->decimal('fuel_cost', 10, 2)->default(0);

            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('emergency_fee', 10, 2)->default(0);

            $table->decimal('subtotal', 10, 2)->default(0);

            $table->decimal('platform_fee', 10, 2)->default(0);

            $table->decimal('total_amount', 10, 2)->default(0);

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('delivery_address')->nullable();

            $table->string('otp', 10)->nullable();

            $table->enum('status', [
                'pending',
                'searching',
                'assigned',
                'accepted',
                'driver_assigned',
                'on_the_way',
                'arrived',
                'fuel_delivering',
                'completed',
                'cancelled',
                'rejected',
                'failed'
            ])->default('pending');

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_requests');
    }
};