<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN role
            ENUM(
                'admin',
                'customer',
                'vendor',
                'finance_partner',
                'roadside_provider',
                'fuel_partner'
            )
            NOT NULL DEFAULT 'customer'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY COLUMN role
            ENUM(
                'admin',
                'customer',
                'vendor',
                'finance_partner',
                'roadside_provider'
            )
            NOT NULL DEFAULT 'customer'
        ");
    }
};