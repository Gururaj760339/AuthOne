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
        Schema::create('car_warranties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('import_request_id')->constrained()->cascadeOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('duration_months');
            $table->integer('max_km');

            $table->enum('type', ['Manufacturer', 'Extended']);
            $table->enum('status', ['Active', 'Expired'])->default('Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_warranties');
    }
};
