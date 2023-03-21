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

        $title = [
            "Holiday home in the heart of the city",
            "Luxury apartment with breathtaking views",
            "Peaceful oasis just a few steps from the center",
            "Romantic cottage immersed in nature",
            "Modern loft in the trendiest neighborhood",
            "Villa with private pool and well-kept garden",
            "Cozy one-bedroom apartment in the historic center",
            "Independent house with panoramic terrace",
            "Studio apartment in a quiet area",
            "Seaside cottage with private access to the beach",
            "Chalet with mountain views",
            "Apartment with panoramic terrace overlooking the lake",
            "Dependance with pool and countryside views",
            "Typical Tuscan house with garden and barbecue",
            "Elegant penthouse in the historic center",
            "Apartment with views of the hills of Florence",
            "Holiday home in the countryside just a stone's throw from the city",
            "Beach bungalow with panoramic veranda",
            "Apartment in the artist's neighborhood",
            "Luxury villa with pool and sea views"
        ];

        $description = [
            "Bright and modern apartment in the heart of the city, just a few steps away from the best restaurants and shops.",
            "Holiday home surrounded by nature, away from the city stress but just 15 minutes by car from the center.",
            "Luxury villa with pool and breathtaking sea view, perfect for a relaxing family or friends vacation.",
            "Stylishly furnished one-bedroom apartment in the artists' quarter, just a few minutes' walk from the main tourist attractions.",
            "Romantic cottage with private garden, ideal for a romantic getaway or a solitary vacation.",
            "Recently renovated apartment with panoramic terrace overlooking the Tuscan hills, perfect for discovering the beauty of this region.",
            "Dependence with private pool, immersed in the tranquility of the countryside but just a few minutes' drive from the historic center.",
            "Mountain chalet with fireplace and view over the valley, ideal for a winter or summer vacation.",
            "Modern and functional studio apartment in the trendiest district of the city, just a few steps away from the best boutiques and nightclubs.",
            "Villa on the sea with private access to the beach, perfect for a summer vacation with family or friends.",
            "Beach bungalow with panoramic veranda, surrounded by greenery and just a few steps from the beautiful sandy beach.",
            "Typical Tuscan house with well-kept garden and view over the countryside, ideal for a vacation of relaxation and good food.",
            "Elegant apartment in the historic center, furnished with antique furniture and equipped with every comfort.",
            "Oasis of peace just a few steps from the center, surrounded by greenery and Tuscan hills.",
            "Attic with panoramic view of the city, equipped with a terrace for enjoying a romantic dinner or breakfast in the open air.",
            "Holiday home in the countryside just a few steps from the city, ideal for discovering the beauty of Tuscany and relaxing away from daily stress.",
            "Bright and modern loft in the heart of the city, perfect for a work or pleasure vacation.",
            "Apartment with lake view and equipped terrace, equipped with every comfort for an unforgettable stay.",
            "Independent house with garden and mountain view, ideal for a winter or summer vacation of sports and relaxation.",
            "Villa with garden and sea view, ideal for a family or friends vacation."
        ];
        $images = [
            "app.Milano.jpg",
            "milano1.jpeg",
            "roma2.jpg",
            "roma3.jpg",
            "roma4.jpg",
            "roma5.jpg",
            "roma6.jpg",
            "milano2.jpeg",
            "milano3.jpeg",
            "milano4.jpeg",
            "milano5.jpeg",

        ];

        $fullAddress = [
            [
                "address" => "Via del Corso, 10, Rome",
                "latitude" => 41.901882,
                "longitude" => 12.483289
            ],
            [
                "address" => "Via Montenapoleone, 25, Milan",
                "latitude" => 45.468133,
                "longitude" => 9.195055
            ],
            [
                "address" => "Piazza della Signoria, 1, Florence
                ",
                "latitude" => 43.7696,
                "longitude" => 11.2558
            ],
            [
                "address" => "Via Condotti, 56, Rome
                ",
                "latitude" => 41.906794,
                "longitude" => 12.480322
            ],
            [
                "address" => "Corso Buenos Aires, 42, Milan",
                "latitude" => 45.4826195,
                "longitude" => 9.2084669
            ],
            [
                "address" => "Via de' Tornabuoni, 7, Florence",
                "latitude" => 43.7728192,
                "longitude" => 11.2532303
            ],
            [
                "address" => "Via Veneto, 1, Rome",
                "latitude" => 41.9051833,
                "longitude" => 12.4885475
            ],
            [
                "address" => "Corso Vittorio Emanuele II, 9, Milan",
                "latitude" => 45.465485,
                "longitude" => 9.195224
            ],
            [
                "address" => "Via dei Calzaiuoli, 13, Florence",
                "latitude" => 43.770327,
                "longitude" => 11.255230
            ],
            [
                "address" => "Via del Babuino, 49, Rome",
                "latitude" => 41.908764,
                "longitude" => 12.478792
            ],
            [
                "address" => "Via Dante, 14, Milan",
                "latitude" => 45.512574,
                "longitude" => 9.157748
            ],
            [
                "address" => "Piazza del Duomo, 9, Florence",
                "latitude" => 43.773171,
                "longitude" => 11.258112
            ],
            [
                "address" => "Via Margutta, 54, Rome",
                "latitude" => 41.907892,
                "longitude" => 12.480504
            ],
            [
                "address" => "Corso di Porta Ticinese, 39, Milan",
                "latitude" => 45.458374,
                "longitude" => 9.181723
            ],
            [
                "address" => "Piazza Santa Croce, 16, Florence",
                "latitude" => 43.768564,
                "longitude" => 11.262277
            ],
            [
                "address" => "Via dei Coronari, 32, Rome",
                "latitude" => 41.900473,
                "longitude" => 12.469794
            ],
            [
                "address" => "Corso Magenta, 22, Milan",
                "latitude" => 45.465862,
                "longitude" => 9.179073
            ],
            [
                "address" => "Via dei Neri, 8, Florence",
                "latitude" => 43.767823,
                "longitude" => 11.259181
            ],
            [
                "address" => "Via Giulia, 123, Rome",
                "latitude" => 41.897827,
                "longitude" => 12.466765
            ],
            [
                "address" => "Via Torino, 64, Milan",
                "latitude" => 45.460827,
                "longitude" => 9.182630
            ],
        ];

        $randAddress = rand(0, 14);
        $rooms_num = rand(1, 10);
        $beds_num = $rooms_num * rand(1, 2);
        $baths_num = ceil($rooms_num / 2);

        return [
            'title' => $title[rand(0, 19)],
            'description' => $description[rand(0, 19)],
            'price' => fake()->randomFloat(2, 20, 110),
            'rooms_num' => $rooms_num,
            'beds_num' => $beds_num,
            'baths_num' => $baths_num,
            'size' => fake()->numberBetween(100, 2000),
            'address' => $fullAddress[$randAddress]["address"],
            'lat' => $fullAddress[$randAddress]["latitude"],
            'long' => $fullAddress[$randAddress]["longitude"],
            // 'imageApartment' => fake()->image(null, 360, 360, 'house', true),
            'imageApartment' => $images[array_rand($images)],

            'visibility' => true,
        ];
    }
}