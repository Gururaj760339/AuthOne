<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('import_requests', function (Blueprint $table) {

            // car_name column delete
            //$table->dropColumn('car_name');

            // car_id add
            $table->foreignId('car_id')
                ->nullable()
                ->constrained('cars')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('import_requests', function (Blueprint $table) {

            $table->dropConstrainedForeignId('car_id');

            $table->string('car_name')->after('user_id');
        });
    }
};
