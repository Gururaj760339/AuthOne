<?php

namespace Database\Seeders;

use App\Models\FinancePartner;
use App\Models\SparePartCategory;
use App\Models\User;
use Database\Seeders\SparePartCategorySeeder as SeedersSparePartCategorySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SparePartCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            FinancePartnerSeeder::class,
            SeedersSparePartCategorySeeder::class,
            SubscriptionPlanSeeder::class,
            CountrySeeder::class
        ]);
    }
}
