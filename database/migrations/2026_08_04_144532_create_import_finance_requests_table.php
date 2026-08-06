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
        Schema::create('import_finance_requests', function (Blueprint $table) {

            $table->id();


            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->foreignId('import_request_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->foreignId('finance_partner_id')
                ->nullable();


            $table->decimal('car_price', 12, 2);


            $table->decimal('loan_amount', 12, 2);


            $table->decimal('down_payment', 12, 2);


            $table->integer('loan_duration');


            $table->decimal('monthly_payment', 12, 2)
                ->nullable();


            $table->enum('status', [

                'pending',
                'approved',
                'rejected'

            ])->default('pending');


            $table->text('remarks')
                ->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_finance_requests');
    }
};
