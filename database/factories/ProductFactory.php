<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->words(4, true),
            'price'       => $this->faker->randomFloat(2, 20, 300),
            'qty'         => $this->faker->numberBetween(5, 50),
            'stock'       => $this->faker->numberBetween(0, 100), // 👈 New field
            'size'        => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
            'image' => $this->faker->image(storage_path('app/public/images'), 640, 480, 'fashion', false),
            'status'      => $this->faker->boolean(80),
            'brand_id'    => Brand::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
