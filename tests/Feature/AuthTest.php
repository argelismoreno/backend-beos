<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('can login with valid credentials', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure(['token', 'user']);
});

it('cannot login with invalid credentials', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});
