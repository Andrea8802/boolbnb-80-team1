<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->text(50),
            'price' => fake()->randomFloat(2, 10, 10000),
            'rooms_num' => fake()->numberBetween(1, 20),
            'beds_num' => fake()->numberBetween(1, 20),
            'baths_num' => fake()->numberBetween(1, 20),
            'size' => fake()->numberBetween(100, 2000),
            'address' => fake()->address(),
            'lat' => fake()->randomFloat(8, 0, 90),
            'long' => fake()->randomFloat(8, 0, 180),
            'imageApartment' => fake()->image(null, 360, 360, 'animals', true),
            'visibility' => fake()->boolean(),
        ];
    }
}