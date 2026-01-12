<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productos = [
            'Televisor 4K 55"',
            'Lentes de Sol Polarizados',
            'Audífonos Noise Cancelling',
            'Smartphone Pro Max',
            'Teclado Mecánico RGB',
            'Monitor Gaming 144Hz',
            'Cámara Reflex Digital',
            'Laptop Ultra Slim',
            'Reloj Inteligente (Smartwatch)',
            'Consola de Videojuegos'
        ];

        return [
            'name' => $this->faker->randomElement($productos) . '-' . $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'currency_id' => Currency::factory(),
            'tax_cost' => $this->faker->randomFloat(2, 1, 50),
            'manufacturing_cost' => $this->faker->randomFloat(2, 5, 200),
        ];
    }
}
