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
        Schema::create('warranty_plans', function (Blueprint $table) {

            $table->id();

            $table->string('name'); // Basic, Premium, Platinum

            $table->integer('duration_months'); // 12, 24, 36

            $table->decimal('price', 10, 2);

            $table->integer('max_km')->nullable(); // 100000 KM

            $table->boolean('engine_coverage')->default(true);

            $table->boolean('transmission_coverage')->default(true);

            $table->boolean('electrical_coverage')->default(false);

            $table->boolean('roadside_assistance')->default(false);

            $table->text('description')->nullable();

            $table->enum('status', ['Active', 'Inactive'])
                  ->default('Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_plans');
    }
};