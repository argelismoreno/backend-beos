<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::factory()
            ->count(3)
            ->sequence(
                ['name' => 'United States Dollar', 'symbol' => '$', 'exchange_rate' => 1.0000],
                ['name' => 'Euro', 'symbol' => '€', 'exchange_rate' => 0.9200],
                ['name' => 'British Pound', 'symbol' => '£', 'exchange_rate' => 0.7900],
            )
            ->create();
    }
}
