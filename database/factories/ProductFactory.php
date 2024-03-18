<?php

namespace Database\Factories;

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
        return [
            'category_id' => fake()->numberBetween(1, 50),
            'name' => fake()->name(),
            'price' => fake()->numberBetween(10000, 50000),
            'image_url' => fake()->imageUrl(),
            'is_available' => fake()->boolean(),
            'slug' => fake()->name(),
        ];
    }
}
