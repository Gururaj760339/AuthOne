<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'services',
            'cars',
            'rentals',
            'spare_parts',
            'payments',
            'bookings',
        ];

        foreach ($tables as $tableName) {

            if (!Schema::hasTable($tableName)) {
                continue;
            }

            if (!Schema::hasColumn($tableName, 'country_id')) {

                Schema::table($tableName, function (Blueprint $table) {
                    $table->foreignId('country_id')
                        ->nullable()
                        ->after('id')
                        ->constrained('countries')
                        ->nullOnDelete();

                    $table->index('country_id');
                });
            }
        }
    }

    public function down(): void
    {
        $tables = [
            'services',
            'cars',
            'rentals',
            'spare_parts',
            'payments',
            'bookings',
        ];

        foreach ($tables as $tableName) {

            if (!Schema::hasTable($tableName)) {
                continue;
            }

            if (Schema::hasColumn($tableName, 'country_id')) {

                Schema::table($tableName, function (Blueprint $table) {

                    $table->dropForeign(['country_id']);
                    $table->dropIndex(['country_id']);
                    $table->dropColumn('country_id');

                });
            }
        }
    }
};