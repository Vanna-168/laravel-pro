<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'T-Shirts',
                'Jackets',
                'Jeans',
                'Dresses',
                'Shoes',
                'Accessories'
            ]),
            'description' => $this->faker->words(4, true),
            'parent_id' => null, // Set to null for top-level categories
        ];
    }
}
