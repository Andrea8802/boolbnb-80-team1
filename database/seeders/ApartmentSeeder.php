<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apartment;
use App\Models\User;
use App\Models\Service;
use App\Models\Sponsor;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $apartmentAddress = ["Via Montenapoleone, 20121 Milano", "Piazza del Duomo, 20122 Milano", "Via Torino, 20123 Milano", "Corso Buenos Aires, 20124 Milano", "Via Dante, 20121 Milano", "Via Manzoni, 20121 Milano", "Via Vittorio Emanuele II, 20121 Milano", "Via Solferino, 20121 Milano", "Via della Spiga, 20121 Milano", "Corso Garibaldi, 20121 Milano", "Via Lincoln, 20124 Milano", "Via Pietro Mascagni, 20122 Milano", "Via Luigi Canonica, 20154 Milano", "Via Pontaccio, 20121 Milano", "Via San Marco, 20121 Milano", "Piazza del Colosseo, 1, 00184 Roma", "Piazza San Pietro, 00120 Città del Vaticano", "Via del Corso, 00187 Roma", "Piazza Navona, 00186 Roma", "Piazza di Spagna, 00187 Roma", "Via dei Fori Imperiali, 00186 Roma", "Via Condotti, 00187 Roma", "Piazza del Popolo, 00187 Roma", "Via Veneto, 00187 Roma", "Largo di Torre Argentina, 00186 Roma", "Piazza della Repubblica, 00185 Roma", "Piazza Venezia, 00186 Roma", "Via Nazionale, 00184 Roma", "Piazza Barberini, 00187 Roma", "Piazza Campo de' Fiori, 00186 Roma"];
        $apartmentTitle = ["Appartamento spazioso e luminoso nel cuore della città",
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
            "Appartamento in zona residenziale con piscina"];


        Apartment::factory()->count(20)->make()->each(function ($ap) {
            $user = User::inRandomOrder()->first();
            $ap->user()->associate($user);
            $ap->save();
            $services = Service::inRandomOrder()->limit(rand(1, 3))->get();
            $ap->services()->attach($services);
            $sponsor = Sponsor::inRandomOrder()->first()->get();
            $ap->sponsors()->attach($sponsor);
        });
    }
}