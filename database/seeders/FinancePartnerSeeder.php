<?php

namespace Database\Seeders;

use App\Models\FinancePartner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancePartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinancePartner::create([
            'name' => 'Demo Bank',
            'interest_rate' => 5.99,
            'max_years' => 5,
        ]);

        FinancePartner::create([
            'name' => 'Auto Finance Ltd',
            'interest_rate' => 6.50,
            'max_years' => 7,
        ]);
    }
}
