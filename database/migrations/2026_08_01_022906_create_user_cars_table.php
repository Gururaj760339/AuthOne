<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('brand');
            $table->string('model');
            $table->year('year');

            $table->string('registration_no')->unique();

            $table->string('color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->integer('seats')->default(5);

            $table->decimal('price_per_day',10,2);

            $table->text('description')->nullable();

            $table->string('main_image')->nullable();

            $table->enum('status',['pending','approved','rejected'])
                  ->default('pending');

            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_cars');
    }
};