<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake()->text(70);

        return [
            'title' => $title,
            'title_sef' => Str::slug($title),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 1, 99999),
            'currency' => fake()->randomElement(['TRY', 'EUR', 'USD']),
        ];
    }
}
