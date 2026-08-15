<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fuel_partner_drivers', function (Blueprint $table) {
            $table->id();

            // Driver's user account
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Fuel partner/company
            $table->foreignId('fuel_partner_id')
                ->constrained('fuel_partners')
                ->cascadeOnDelete();

            $table->string('driver_name');
            $table->string('phone')->nullable();

            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();

            $table->string('national_id')->nullable();

            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_type')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'active',
                'inactive',
                'suspended'
            ])->default('pending');

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_partner_drivers');
    }
};