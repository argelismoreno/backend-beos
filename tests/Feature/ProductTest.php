<?php

use App\Models\Currency;
use App\Models\Product;
use App\Models\User;

it('can list products', function () {
    Product::factory()->count(3)->create();

    $response = $this->getJson('/api/products');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'currency_id',
                    'tax_cost',
                    'manufacturing_cost',
                    'currency',
                    'prices',
                ]
            ]
        ]);
});

it('can create a product', function () {
    $user = User::factory()->create();
    $currency = Currency::factory()->create();
    $data = [
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 100.00,
        'currency_id' => $currency->id,
        'tax_cost' => 10.00,
        'manufacturing_cost' => 50.00,
    ];

    $response = $this->actingAs($user)->postJson('/api/products', $data);

    $response->assertStatus(201)
        ->assertJsonPath('data.name', 'Test Product');

    $this->assertDatabaseHas('products', ['name' => 'Test Product']);
});

it('can show a product', function () {
    $product = Product::factory()->create();

    $response = $this->getJson("/api/products/{$product->id}");

    $response->assertStatus(200)
        ->assertJsonPath('data.id', $product->id);
});

it('can update a product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $data = ['name' => 'Updated Name'];

    $response = $this->actingAs($user)->putJson("/api/products/{$product->id}", $data);

    $response->assertStatus(200)
        ->assertJsonPath('data.name', 'Updated Name');

    $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Updated Name']);
});

it('can delete a product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->deleteJson("/api/products/{$product->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});
