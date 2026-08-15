<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [

            // GCC
            [
                'name' => 'United Arab Emirates',
                'code' => 'AE',
                'iso3' => 'ARE',
                'phone_code' => '+971',
                'currency_code' => 'AED',
                'currency_symbol' => 'د.إ',
                'default_locale' => 'ar',
                'timezone' => 'Asia/Dubai',
                'region' => 'GCC',
                'vat_rate' => 5,
            ],

            [
                'name' => 'Saudi Arabia',
                'code' => 'SA',
                'iso3' => 'SAU',
                'phone_code' => '+966',
                'currency_code' => 'SAR',
                'currency_symbol' => '﷼',
                'default_locale' => 'ar',
                'timezone' => 'Asia/Riyadh',
                'region' => 'GCC',
                'vat_rate' => 15,
            ],

            [
                'name' => 'Qatar',
                'code' => 'QA',
                'iso3' => 'QAT',
                'phone_code' => '+974',
                'currency_code' => 'QAR',
                'currency_symbol' => '﷼',
                'default_locale' => 'ar',
                'timezone' => 'Asia/Qatar',
                'region' => 'GCC',
                'vat_rate' => 0,
            ],

            [
                'name' => 'Kuwait',
                'code' => 'KW',
                'iso3' => 'KWT',
                'phone_code' => '+965',
                'currency_code' => 'KWD',
                'currency_symbol' => 'د.ك',
                'default_locale' => 'ar',
                'timezone' => 'Asia/Kuwait',
                'region' => 'GCC',
                'vat_rate' => 0,
            ],

            [
                'name' => 'Bahrain',
                'code' => 'BH',
                'iso3' => 'BHR',
                'phone_code' => '+973',
                'currency_code' => 'BHD',
                'currency_symbol' => '.د.ب',
                'default_locale' => 'ar',
                'timezone' => 'Asia/Bahrain',
                'region' => 'GCC',
                'vat_rate' => 10,
            ],

            [
                'name' => 'Oman',
                'code' => 'OM',
                'iso3' => 'OMN',
                'phone_code' => '+968',
                'currency_code' => 'OMR',
                'currency_symbol' => '﷼',
                'default_locale' => 'ar',
                'timezone' => 'Asia/Muscat',
                'region' => 'GCC',
                'vat_rate' => 5,
            ],

            // Egypt
            [
                'name' => 'Egypt',
                'code' => 'EG',
                'iso3' => 'EGY',
                'phone_code' => '+20',
                'currency_code' => 'EGP',
                'currency_symbol' => 'E£',
                'default_locale' => 'ar',
                'timezone' => 'Africa/Cairo',
                'region' => 'Egypt',
                'vat_rate' => 14,
            ],

            // North Africa
            [
                'name' => 'Morocco',
                'code' => 'MA',
                'iso3' => 'MAR',
                'phone_code' => '+212',
                'currency_code' => 'MAD',
                'currency_symbol' => 'د.م.',
                'default_locale' => 'ar',
                'timezone' => 'Africa/Casablanca',
                'region' => 'North Africa',
                'vat_rate' => 20,
            ],

            [
                'name' => 'Algeria',
                'code' => 'DZ',
                'iso3' => 'DZA',
                'phone_code' => '+213',
                'currency_code' => 'DZD',
                'currency_symbol' => 'دج',
                'default_locale' => 'ar',
                'timezone' => 'Africa/Algiers',
                'region' => 'North Africa',
                'vat_rate' => 19,
            ],

            [
                'name' => 'Tunisia',
                'code' => 'TN',
                'iso3' => 'TUN',
                'phone_code' => '+216',
                'currency_code' => 'TND',
                'currency_symbol' => 'د.ت',
                'default_locale' => 'ar',
                'timezone' => 'Africa/Tunis',
                'region' => 'North Africa',
                'vat_rate' => 19,
            ],

            [
                'name' => 'Libya',
                'code' => 'LY',
                'iso3' => 'LBY',
                'phone_code' => '+218',
                'currency_code' => 'LYD',
                'currency_symbol' => 'ل.د',
                'default_locale' => 'ar',
                'timezone' => 'Africa/Tripoli',
                'region' => 'North Africa',
                'vat_rate' => 0,
            ],

            [
                'name' => 'Mauritania',
                'code' => 'MR',
                'iso3' => 'MRT',
                'phone_code' => '+222',
                'currency_code' => 'MRU',
                'currency_symbol' => 'UM',
                'default_locale' => 'ar',
                'timezone' => 'Africa/Nouakchott',
                'region' => 'North Africa',
                'vat_rate' => 16,
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                $country
            );
        }
    }
}