<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SparePartCategory;
use Illuminate\Support\Str;

class SparePartCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Tires',
            'Brakes',
            'Batteries',
            'Oils',
            'Accessories',
        ];

        foreach ($categories as $category) {
            SparePartCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}