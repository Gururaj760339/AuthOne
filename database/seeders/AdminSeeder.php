<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Guru Charan Rajbangshi',
            'email' => 'www.gururaj555@gmail.com',
            'phone' => '01405792315',
            'password' => Hash::make('R@j760339'),
            'role' => 'admin'
        ]);

        ServiceCategory::create([
            'name' => 'Workshops & Maintenance',
            'slug' => Str::slug('Workshops & Maintenance'),
            'icon' => 'fa-solid fa-wrench',
        ]);

        ServiceCategory::create([
            'name' => 'Car Wash Services',
            'slug' => Str::slug('Car Wash Services'),
            'icon' => 'fa-solid fa-soap',
        ]);

        Setting::create([
            'website_name' => 'AutoOne',
            'logo' => '',
            'email' => 'www.gururaj555@gmail.com',
            'phone' => '+8801405792315',
            'address' => 'Dubai, UAE',
            'facebook' => 'https://facebook.com/autoone',
            'instagram' => 'https://instagram.com/autoone',
            'youtube' => 'https://youtube.com/@autoone',
        ]);
    }
}
