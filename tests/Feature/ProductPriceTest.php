<?php

use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;

it('can list prices for a product', function () {
    $product = Product::factory()->create();
    ProductPrice::factory()->count(2)->for($product)->create();

    $response = $this->getJson("/api/products/{$product->id}/prices");

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

it('can add a price to a product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $currency = Currency::factory()->create();

    $data = [
        'currency_id' => $currency->id,
        'price' => 150.01,
    ];

    $response = $this->actingAs($user)->postJson("/api/products/{$product->id}/prices", $data);

    $response->assertStatus(201)
        ->assertJsonPath('data.price', 150.01);

    $this->assertDatabaseHas('product_prices', [
        'product_id' => $product->id,
        'currency_id' => $currency->id,
        'price' => 150.01,
    ]);
});
