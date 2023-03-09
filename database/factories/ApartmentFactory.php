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
            "Casa vacanza nel cuore della città",
            "Appartamento di lusso con vista mozzafiato",
            "Oasi di pace a pochi passi dal centro",
            "Cottage romantico immerso nella natura",
            "Loft moderno nel quartiere più trendy",
            "Villa con piscina privata e giardino curato",
            "Bilocale accogliente nel centro storico",
            "Casa indipendente con terrazza panoramica",
            "Monolocale in zona tranquilla",
            "Villetta sul mare con accesso privato alla spiaggia",
            "Chalet con vista sulle montagne",
            "Appartamento con terrazza panoramica sul lago",
            "Dependance con piscina e vista sulla campagna",
            "Casa tipica toscana con giardino e barbecue",
            "Attico elegante nel centro storico",
            "Appartamento con vista sulle colline di Firenze",
            "Casa vacanze in campagna a due passi dalla città",
            "Bungalow sulla spiaggia con veranda panoramica",
            "Appartamento nel quartiere degli artisti",
            "Villa di lusso con piscina e vista sul mare"
        ];

        $description = [
            "Appartamento luminoso e moderno nel cuore della città, a due passi dai migliori ristoranti e negozi.",
            "Casa vacanza immersa nella natura, lontana dallo stress cittadino ma a soli 15 minuti di macchina dal centro.",
            "Villa di lusso con piscina e vista mozzafiato sul mare, perfetta per una vacanza di relax in famiglia o con gli amici.",
            "Bilocale arredato con stile nel quartiere degli artisti, a pochi minuti a piedi dalle principali attrazioni turistiche.",
            "Cottage romantico con giardino privato, ideale per una fuga romantica o una vacanza in solitudine.",
            "Appartamento ristrutturato di recente con terrazza panoramica sulle colline toscane, perfetto per scoprire la bellezza di questa regione.",
            "Dependance con piscina privata, immersa nella quiete della campagna ma a pochi minuti di macchina dal centro storico.",
            "Chalet di montagna con camino e vista sulla vallata, ideale per una vacanza invernale o estiva.",
            "Monolocale moderno e funzionale nel quartiere più trendy della città, a pochi passi dalle migliori boutiques e locali notturni.",
            "Villa sul mare con accesso privato alla spiaggia, perfetta per una vacanza estiva con la famiglia o gli amici.",
            "Bungalow sulla spiaggia con veranda panoramica, immerso nel verde e a pochi passi dalla bellissima spiaggia di sabbia.",
            "Casa tipica toscana con giardino curato e vista sulla campagna, ideale per una vacanza all'insegna del relax e della buona cucina.",
            "Appartamento elegante nel centro storico, arredato con mobili d'epoca e dotato di ogni comfort.",
            "Oasi di pace a pochi passi dal centro, circondata dal verde e dalle colline toscane.",
            "Attico con vista panoramica sulla città, dotato di terrazza attrezzata per godere di una cena romantica o una colazione all'aria aperta.",
            "Casa vacanze in campagna a due passi dalla città, ideale per scoprire la bellezza della Toscana e rilassarsi lontano dallo stress quotidiano.",
            "Loft moderno e luminoso nel cuore della città, perfetto per una vacanza di lavoro o di piacere.",
            "Appartamento con vista sul lago e terrazza attrezzata, dotato di ogni comfort per un soggiorno indimenticabile.",
            "Casa indipendente con giardino e vista sulle montagne, ideale per una vacanza invernale o estiva all'insegna dello sport e del relax.",
            "Villetta con giardino e vista sul mare, ideale per una vacanza in famiglia o con gli amici."
        ];

        $fullAddress = [
            [
                "address" => "Via della Spiga, 1, 20121 Milano",
                "latitude" => 45.468,
                "longitude" => 9.195
            ],
            [
                "address" => "Via Montenapoleone, 6, 20121 Milano",
                "latitude" => 45.468,
                "longitude" => 9.194
            ],
            [
                "address" => "Via Manzoni, 31, 20121 Milano",
                "latitude" => 45.470,
                "longitude" => 9.198
            ],
            [
                "address" => "Piazza del Duomo, 14, 20122 Milano",
                "latitude" => 45.464,
                "longitude" => 9.189
            ],
            [
                "address" => "Via Dante, 7, 20121 Milano",
                "latitude" => 45.465,
                "longitude" => 9.187
            ],
            [
                "address" => "Corso Vittorio Emanuele II, 1, 20122 Milano",
                "latitude" => 45.462,
                "longitude" => 9.191
            ],
            [
                "address" => "Galleria Vittorio Emanuele II, 20121 Milano",
                "latitude" => 45.465,
                "longitude" => 9.190
            ],
            [
                "address" => "Via Mercato, 1, 20121 Milano",
                "latitude" => 45.464,
                "longitude" => 9.187
            ],
            [
                "address" => "Piazza San Babila, 20122 Milano",
                "latitude" => 45.466,
                "longitude" => 9.200
            ],
            [
                "address" => "Via Torino, 61, 20123 Milano",
                "latitude" => 45.460,
                "longitude" => 9.181
            ],
            [
                "address" => "Via Larga, 8, 20122 Milano",
                "latitude" => 45.466,
                "longitude" => 9.193
            ],
            [
                "address" => "Via Montenapoleone, 24, 20121 Milano",
                "latitude" => 45.468,
                "longitude" => 9.193
            ],
            [
                "address" => "Via della Moscova, 28, 20121 Milano",
                "latitude" => 45.476,
                "longitude" => 9.186
            ],
            [
                "address" => "Via Paolo Sarpi, 8, 20154 Milano",
                "latitude" => 45.483,
                "longitude" => 9.175
            ],
            [
                "address" => "Via Madonnina, 10, 20121 Milano",
                "latitude" => 45.467,
                "longitude" => 9.187
            ],
            [
                "address" => "Via Brera, 28, 20121 Milano",
                "latitude" => 45.472,
                "longitude" => 9.187
            ],
            [
                "address" => "Via della Moscova, 28, 20121 Milano",
                "latitude" => 45.477842,
                "longitude" => 9.189183
            ],
            [
                "address" => "Via Paolo Sarpi, 8, 20154 Milano",
                "latitude" => 45.477391,
                "longitude" => 9.178897
            ],
            [
                "address" => "Via Torino, 61, 20123 Milano",
                "latitude" => 45.4647598,
                "longitude" => 9.1879917
            ],
            [
                "address" => "Via Larga, 8, 20122 Milano",
                "latitude" => 45.4633233,
                "longitude" => 9.2002153
            ],
        ];

        $randAddress = rand(0, 19);
        $rooms_num = rand(1, 20);
        $beds_num = $rooms_num * rand(1, 2);
        $baths_num = ceil($rooms_num / 2);

        return [
            'title' => $title[rand(0, 19)],
            'description' => $description[rand(0, 19)],
            'price' => fake()->randomFloat(2, 20, 10000),
            'rooms_num' => $rooms_num,
            'beds_num' => $beds_num,
            'baths_num' => $baths_num,
            'size' => fake()->numberBetween(100, 2000),
            'address' => $fullAddress[$randAddress]["address"],
            'lat' => $fullAddress[$randAddress]["latitude"],
            'long' => $fullAddress[$randAddress]["longitude"],
            'image' => fake()->image(null, 360, 360, 'house', true),
            'visibility' => true,
        ];
    }
}