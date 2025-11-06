<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['code' => 'USD', 'name' => '',],
            ['code' => 'EUR', 'name' => '',],
            ['code' => 'GBP', 'name' => '',],
            ['code' => 'AUD', 'name' => '',],
            ['code' => 'BRL', 'name' => '',],
            ['code' => 'CAD', 'name' => '',],
            ['code' => 'CNY', 'name' => '',],
            ['code' => 'CZK', 'name' => '',],
            ['code' => 'DKK', 'name' => '',],
            ['code' => 'HKD', 'name' => '',],
            ['code' => 'HUF', 'name' => '',],
            ['code' => 'INR', 'name' => '',],
        ];

<<<<<<< HEAD
       foreach ($currencies as $currency) {
=======
        foreach ($currencies as $currency) {
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
            DB::table('currencies')->updateOrInsert(
                ['code' => $currency['code']], // Match by code
                [
                    'name' => $currency['name'],
                ]
            );
        }
    }
}
