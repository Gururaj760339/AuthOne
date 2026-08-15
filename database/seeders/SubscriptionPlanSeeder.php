<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        SubscriptionPlan::create([
            'name' => 'VIP Silver',
            'slug' => 'vip-silver',
            'description' => 'Basic VIP membership',
            'price' => 49,
            'currency' => 'AED',
            'duration_days' => 30,

            'discount_percentage' => 5,
            'roadside_discount' => 5,
            'car_wash_discount' => 5,
            'rental_discount' => 5,

            'priority_booking' => false,
            'free_inspection' => false,

            'status' => true,
        ]);


        SubscriptionPlan::create([
            'name' => 'VIP Gold',
            'slug' => 'vip-gold',
            'description' => 'Most popular VIP membership',
            'price' => 99,
            'currency' => 'AED',
            'duration_days' => 30,

            'discount_percentage' => 10,
            'roadside_discount' => 10,
            'car_wash_discount' => 10,
            'rental_discount' => 10,

            'priority_booking' => true,
            'free_inspection' => true,

            'status' => true,
        ]);


        SubscriptionPlan::create([
            'name' => 'VIP Platinum',
            'slug' => 'vip-platinum',
            'description' => 'Premium VIP membership',
            'price' => 199,
            'currency' => 'AED',
            'duration_days' => 30,

            'discount_percentage' => 20,
            'roadside_discount' => 20,
            'car_wash_discount' => 20,
            'rental_discount' => 20,

            'priority_booking' => true,
            'free_inspection' => true,

            'status' => true,
        ]);
    }
}