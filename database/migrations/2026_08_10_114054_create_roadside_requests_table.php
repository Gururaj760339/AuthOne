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
        Schema::create('roadside_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('cars')
                ->nullOnDelete();

            $table->foreignId('provider_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('assistance_type', [
                'flat_tire',
                'battery',
                'fuel_delivery',
                'engine_problem',
                'lockout',
                'accident',
                'towing',
                'other'
            ]);

            $table->text('description')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('address')->nullable();

            $table->enum('priority', [
                'normal',
                'urgent',
                'emergency'
            ])->default('normal');

            $table->enum('status', [
                'pending',
                'searching',
                'accepted',
                'on_the_way',
                'arrived',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('final_cost', 10, 2)->nullable();

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadside_requests');
    }
};
