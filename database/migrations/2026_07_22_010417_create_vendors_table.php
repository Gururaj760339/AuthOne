<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('vendor_type', [
                'service',
                'dealer',
                'rental',
                'car_importer'
            ]);

            $table->string('business_name');

            $table->string('owner_name')->nullable();

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('logo')->nullable();

            $table->string('cover_image')->nullable();

            $table->text('description')->nullable();

            $table->string('trade_license')->nullable();

            // Changed
            $table->string('address')->nullable();

            $table->string('city')->nullable();

            $table->string('country')->default('UAE');

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('opening_time')->nullable();

            $table->string('closing_time')->nullable();

            $table->boolean('is_verified')->default(false);

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'suspended'
            ])->default('pending');

            $table->decimal('rating', 2, 1)->default(0);

            $table->integer('total_reviews')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};