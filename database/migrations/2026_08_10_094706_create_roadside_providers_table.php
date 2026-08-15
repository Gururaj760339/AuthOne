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
        Schema::create('roadside_providers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('company_name');
            $table->string('phone');

            $table->enum('provider_type', [
                'tow_truck',
                'mechanic',
                'mobile_mechanic',
                'battery_service',
                'fuel_delivery',
                'roadside_company'
            ]);

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->boolean('is_available')->default(true);
            $table->boolean('is_verified')->default(false);

            $table->decimal('rating', 3, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadside_providers');
    }
};
