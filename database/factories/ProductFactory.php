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
    public function definition()
    {
        return [
            'name'        => $this->faker->text(),
            'description' => $this->faker->text(),
            'price'       => $this->faker->numberBetween(100, 1000000),
            // TODO:
//            'image'       => $this->faker->image(),
        ];
    }
}
