<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_warranties', function (Blueprint $table) {

            $table->foreignId('warranty_plan_id')
                ->nullable()
                ->after('import_request_id')
                ->constrained('warranty_plans')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('car_warranties', function (Blueprint $table) {
            $table->dropConstrainedForeignId('warranty_plan_id');
        });
    }
};
