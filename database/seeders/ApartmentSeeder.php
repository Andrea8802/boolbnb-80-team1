<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



use App\Models\User;
use App\Models\Statistic;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Apartment;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $apartmentAddress = [
            "Via Montenapoleone, 20121 Milano",
            "Piazza del Duomo, 20122 Milano",
            "Via Torino, 20123 Milano",
            "Corso Buenos Aires, 20124 Milano",
            "Via Dante, 20121 Milano",
            "Via Manzoni, 20121 Milano",
            "Via Vittorio Emanuele II, 20121 Milano",
            "Via Solferino, 20121 Milano",
            "Via della Spiga, 20121 Milano",
            "Corso Garibaldi, 20121 Milano",
            "Via Lincoln, 20124 Milano",
            "Via Pietro Mascagni, 20122 Milano",
            "Via Luigi Canonica, 20154 Milano",
            "Via Pontaccio, 20121 Milano",
            "Via San Marco, 20121 Milano",
            "Via del Corso, 00186 Roma RM",
            "Via dei Fori Imperiali, 00186 Roma RM",
            "Piazza di Spagna, 00187 Roma RM",
            "Via Veneto, 00187 Roma RM",
            "Viale dei Parioli, 00197 Roma RM",
            "Via Nazionale, 00184 Roma RM",
            "Piazza Navona, 00186 Roma RM",
            "Via del Babuino, 00187 Roma RM",
            "Via Appia Antica, 00178 Roma RM",
            "Via della Conciliazione, 00193 Roma RM",
            "Piazza San Pietro, 00120 Città del Vaticano",
            "Via del Tritone, 00187 Roma RM",
            "Piazza del Popolo, 00187 Roma RM",
            "Via Cola di Rienzo, 00192 Roma RM",
            "Piazza Venezia, 00187 Roma RM"
        ];
        $apartmentLat = [
            45.46893,
            45.46415,
            45.46363,
            45.48235,
            45.46470,
            45.47096,
            45.46403,
            45.47669,
            45.46941,
            45.48205,
            45.48692,
            45.46368,
            45.47775,
            45.47173,
            45.47423,
            41.9008,
            41.8949,
            41.9057,
            41.9078,
            41.9189,
            41.9005,
            41.8992,
            41.9071,
            41.8527,
            41.9022,
            41.9022,
            41.9047,
            41.9104,
            41.9082,
            41.8955,
        ];
        $apartmentLong = [
            9.19550,
            9.18951,
            9.18541,
            9.21505,
            9.18987,
            9.19600,
            9.19002,
            9.19220,
            9.19512,
            9.18585,
            9.20435,
            9.19238,
            9.17271,
            9.18727,
            9.18775,
            12.4815,
            12.4853,
            12.4823,
            12.4886,
            12.4905,
            12.4953,
            12.4733,
            12.4769,
            12.5151,
            12.4568,
            12.4578,
            12.4874,
            12.4768,
            12.4663,
            12.4828,
        ];
        $apartmentTitle = [
            "Appartamento spazioso e luminoso nel cuore della città",
            "Accogliente bilocale con vista panoramica sul mare",
            "Elegante trilocale arredato con gusto",
            "Monolocale moderno e confortevole",
            "Appartamento completamente ristrutturato con finiture di pregio",
            "Ampio quadrilocale con terrazza panoramica",
            "Bilocale in zona tranquilla e silenziosa",
            "Monolocale con giardino privato",
            "Appartamento luminoso con affaccio su verde pubblico",
            "Trilocale arredato con terrazzo vivibile",
            "Bilocale in palazzo d'epoca con soffitti alti",
            "Attico di lusso con vista mozzafiato sulla città",
            "Monolocale vicino al centro storico",
            "Appartamento a due passi dalla stazione ferroviaria",
            "Trilocale con camino e travi a vista",
            "Bilocale arredato in stile moderno",
            "Ampio appartamento con doppi servizi",
            "Monolocale in zona universitaria",
            "Appartamento con cucina abitabile e balcone",
            "Trilocale con due bagni e cabina armadio",
            "Bilocale con angolo cottura e zona notte separata",
            "Appartamento con terrazzo panoramico e barbecue",
            "Attico ristrutturato con vista sul fiume",
            "Monolocale in palazzo d'epoca con ascensore",
            "Appartamento luminoso con affaccio su piazza",
            "Trilocale con cantina e posto auto",
            "Bilocale con caminetto e vista sulle montagne",
            "Appartamento con giardino condominiale",
            "Ampio monolocale con soppalco",
            "Appartamento in zona residenziale con piscina"
        ];
        $apartmentDescr = [
            "Splendido appartamento nel cuore del centro storico, con vista panoramica sulla città",
            "Casa vacanze immersa nella natura, circondata da boschi e prati verdi",
            "Lussuoso attico con terrazza privata e vista sul mare",
            "Casa sull'albero in un bosco incantato, perfetta per una vacanza avventurosa",
            "Casa colonica ristrutturata con giardino e piscina privata",
            "Appartamento moderno e spazioso nel quartiere più alla moda della città",
            "Villa con vista mozzafiato sulle montagne circostanti e piscina panoramica",
            "Caratteristica casa di campagna in pietra, immersa nel verde e nella quiete",
            "Appartamento di design nel centro storico, arredato con gusto e stile",
            "Casa vacanze con accesso diretto alla spiaggia, ideale per una vacanza al mare",
            "Agriturismo con fattoria didattica e prodotti tipici locali a km zero",
            "Casa vacanze con ampio giardino e barbecue, perfetta per una vacanza all'aria aperta",
            "Chalet di montagna con camino e vista panoramica sulle cime innevate",
            "Appartamento con terrazza e vista sul Duomo, nel cuore del centro storico",
            "Casa vacanze sulla spiaggia, con veranda e giardino privati",
            "Dimora storica ristrutturata nel centro storico, con arredi d'epoca e ogni comfort",
            "Baita di montagna con sauna e idromassaggio, ideale per una vacanza di relax",
            "Casa indipendente con giardino e piscina, immersa nel verde e nella tranquillità",
            "Appartamento in villa d'epoca con vista sul mare e accesso diretto alla spiaggia",
            "Casa vacanze immersa nella campagna, con ampio giardino e frutteto",
            "Villa con piscina e vista sul lago, ideale per una vacanza di lusso e relax",
            "Appartamento con balcone panoramico e vista sulle montagne circostanti",
            "Casa di charme nel centro storico, con terrazza e vista sulla città",
            "Chalet in legno con camino e vista sulle Dolomiti, perfetto per una vacanza invernale",
            "Casa vacanze in stile rustico, con giardino e barbecue per grigliate all'aperto",
            "Appartamento con terrazza e vista sulla costa, a due passi dalla spiaggia",
            "Casa vacanze in un antico borgo medievale, con vista panoramica sulla valle",
            "Villa di lusso con piscina e giardino privato, immersa nella quiete della campagna",
            "Appartamento moderno e luminoso con vista sul porto, nel cuore della movida cittadina",
            "Casa vacanze con accesso privato alla spiaggia, ideale per gli amanti del mare"
        ];
        $apartmentPrice = [55.50, 78.00, 89.99, 102.25, 115.75, 129.50,
            141.80, 154.25, 167.00, 181.25, 195.75, 210.50,
            224.75, 239.50, 254.75, 269.50, 284.75, 299.50,
            31.75, 47.50, 63.75, 82.50, 97.25, 112.50,
            129.25, 147.50, 165.75, 182.50, 198.25, 215.50];
        $apartmentBath_num = [3, 4, 5, 2, 4, 1, 1, 2, 4, 3,
            2, 5, 4, 1, 5, 3, 1, 4, 2, 3,
            5, 2, 4, 3, 1, 1, 3, 5, 2, 4];
        $apartmentBeds_num = [
            6,
            3,
            5,
            5,
            3,
            3,
            5,
            7,
            2,
            4,
            2,
            4,
            4,
            5,
            6,
            3,
            5,
            5,
            5,
            7,
            2,
            5,
            5,
            3,
            5,
            5,
            7,
            3,
            2,
            7,
        ];
        $apartmentRoom_num = [8,
            9,
            8,
            2,
            9,
            9,
            6,
            7,
            7,
            4,
            7,
            6,
            5,
            8,
            3,
            2,
            8,
            9,
            8,
            6,
            8,
            5,
            3,
            5,
            4,
            7,
            6,
            9,
            2,
            5,
        ];
        $apartmentSize = [
            87,
            121,
            178,
            122,
            109,
            70,
            172,
            105,
            111,
            59,
            107,
            145,
            160,
            144,
            146,
            103,
            126,
            143,
            196,
            90,
            74,
            74,
            90,
            152,
            61,
            131,
            67,
            61,
            130,
            136,
        ];
        $apartments = [];
        for ($i = 0; $i < 30; $i++) {
            $newApartment = [
                'title' => $apartmentTitle[$i],
                'description' => $apartmentDescr[$i],
                'price' => $apartmentPrice[$i],
                'rooms_num' => $apartmentRoom_num[$i],
                'beds_num' => $apartmentBeds_num[$i],
                'baths_num' => $apartmentBath_num[$i],
                'size' => $apartmentSize[$i],
                'address' => $apartmentAddress[$i],
                'lat' => $apartmentLat[$i],
                'long' => $apartmentLong[$i],
                'image' => asset('storage/app/public/avatar5.png'),
                'visibility' => true,
            ];
            array_push($apartments, $newApartment);
        }
        ;
        foreach ($apartments as $apartment) {
            Apartment::make([$apartment])->each(function ($ap) {
                $user = User::inRandomOrder()->first();
                $ap->user()->associate($user);
                $ap->save();
                $statistic = Statistic::inRandomOrder()->limit(rand(1, 5))->get();
                $ap->statistics()->attach($statistic);
                $message = Message::inRandomOrder()->first()->get();
                $ap->messages()->attach($message);
                $services = Service::inRandomOrder()->limit(rand(1, 3))->get();
                $ap->services()->attach($services);
                $sponsor = Sponsor::inRandomOrder()->first()->get();
                $ap->sponsors()->attach($sponsor);
            });
        }
        ;

        /* Apartment::factory()->make()->each(function ($ap) {
        $user = User::inRandomOrder()->first();
        $ap->user()->associate($user);
        $ap->save();
        $services = Service::inRandomOrder()->limit(rand(1, 3))->get();
        $ap->services()->attach($services);
        $sponsor = Sponsor::inRandomOrder()->first()->get();
        $ap->sponsors()->attach($sponsor);
        });
        */

        /* Apartment::factory()->count(20)->make()->each(function ($ap) {
        $user = User::inRandomOrder()->first();
        $ap->user()->associate($user);
        $ap->save();
        $services = Service::inRandomOrder()->limit(rand(1, 3))->get();
        $ap->services()->attach($services);
        $sponsor = Sponsor::inRandomOrder()->first()->get();
        $ap->sponsors()->attach($sponsor);
        }); */
    }
}