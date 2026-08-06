<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE payments
            MODIFY payment_for ENUM(
                'finance',
                'rental',
                'import',
                'service',
                'warranty_extended'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE payments
            MODIFY payment_for ENUM(
                'finance',
                'rental',
                'import',
                'service'
            ) NOT NULL
        ");
    }
};