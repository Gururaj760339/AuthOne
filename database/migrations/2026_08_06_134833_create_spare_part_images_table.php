<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spare_part_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('spare_part_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('image');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spare_part_images');
    }
};