<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('p2p_bookings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('car_id')
                  ->constrained('user_cars')
                  ->cascadeOnDelete();

            $table->foreignId('owner_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('renter_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->date('pickup_date');

            $table->date('return_date');

            $table->decimal('price_per_day',10,2);

            $table->integer('days');

            $table->decimal('total_amount',10,2);

            $table->enum('status',[
                'pending',
                'accepted',
                'rejected',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('p2p_bookings');
    }
};