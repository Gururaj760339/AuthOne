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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('brand_id')
                ->constrained('car_brands')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 12, 2);
            $table->year('year');
            $table->string('fuel_type');
            $table->string('transmission');
            $table->integer('mileage');
            $table->string('engine')->nullable();
            $table->integer('horsepower')->nullable();
            $table->string('color')->nullable();
            $table->string('condition')->default('Used');
            $table->longText('description');
            $table->string('thumbnail')->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
