<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = Currency::all();

        if ($currencies->isEmpty()) {
            return;
        }

        Product::factory()
            ->count(20)
            ->recycle($currencies)
            ->create()
            ->each(function ($product) use ($currencies) {
                // 1. Create a ProductPrice entry for the product's base currency and price
                // This ensures the base price shows up in the 'prices' list
                ProductPrice::create([
                    'product_id' => $product->id,
                    'currency_id' => $product->currency_id,
                    'price' => $product->price,
                ]);

                // 2. Add prices in ALL other currencies
                $otherCurrencies = $currencies->where('id', '!=', $product->currency_id);

                foreach ($otherCurrencies as $currency) {
                    ProductPrice::factory()
                        ->state([
                            'product_id' => $product->id,
                            'currency_id' => $currency->id,
                        ])
                        ->create();
                }
            });
    }
}
