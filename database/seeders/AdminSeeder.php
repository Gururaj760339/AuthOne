<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
    }
}
