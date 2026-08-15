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
        Schema::table('roadside_requests', function (Blueprint $table) {

            $table->timestamp('on_the_way_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('roadside_requests', function (Blueprint $table) {

            $table->dropColumn([
                'accepted_at',
                'on_the_way_at',
                'arrived_at',
                'started_at',
                'completed_at',
                'cancelled_at',
            ]);
        });
    }
};
