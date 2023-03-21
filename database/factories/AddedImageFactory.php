<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddedImage>
 */
class AddedImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $images = [
            "cucina1.jpeg",
            "letto1.jpg",
            "bagno1.jpg",
            "salotto1.jpg"

        ];
        return [
            /* "name" => fake()->word(), */
            // "image" => 'https://picsum.photos/800/600?random=' . fake()->randomNumber(5, true),


            "image" => $images[array_rand($images)]
        ];
    }
}