<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code', 2)->unique();       // AE, SA, QA
            $table->string('iso3', 3)->nullable();     // ARE, SAU
            $table->string('phone_code', 10)->nullable();

            $table->string('currency_code', 3);        // AED, SAR, QAR
            $table->string('currency_symbol', 10)->nullable();

            $table->string('default_locale', 10)->default('en');
            $table->string('timezone')->nullable();

            $table->string('region')->nullable();
            // GCC, Egypt, North Africa

            $table->decimal('vat_rate', 5, 2)->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
