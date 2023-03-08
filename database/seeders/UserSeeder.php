<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userArray = [
            array(
                "nome" => "Marco",
                "cognome" => "Rossi",
                "data_di_nascita" => "1990-03-15",
                "email" => "marco.rossi@example.com",
                "password" => "qwe123",
                "descrizione" => "Appassionato di calcio"
            ),
            array(
                "nome" => "Francesca",
                "cognome" => "Bianchi",
                "data_di_nascita" => "1985-05-23",
                "email" => "francesca.bianchi@example.com",
                "password" => "asd456",
                "descrizione" => "Amante della natura"
            ),
            array(
                "nome" => "Luca",
                "cognome" => "Verdi",
                "data_di_nascita" => "1992-07-11",
                "email" => "luca.verdi@example.com",
                "password" => "zxc789",
                "descrizione" => "Appassionato di cinema"
            ),
            array(
                "nome" => "Giulia",
                "cognome" => "Neri",
                "data_di_nascita" => "1988-09-02",
                "email" => "giulia.neri@example.com",
                "password" => "poi098",
                "descrizione" => "Amante dei viaggi"
            ),
            array(
                "nome" => "Alessandro",
                "cognome" => "Russo",
                "data_di_nascita" => "1995-01-07",
                "email" => "alessandro.russo@example.com",
                "password" => "mnb654",
                "descrizione" => "Appassionato di musica"
            ),
            array(
                "nome" => "Martina",
                "cognome" => "Ferrari",
                "data_di_nascita" => "1998-04-09",
                "email" => "martina.ferrari@example.com",
                "password" => "lkj321",
                "descrizione" => "Amante degli animali"
            ),
            array(
                "nome" => "Gabriele",
                "cognome" => "Romano",
                "data_di_nascita" => "1991-12-03",
                "email" => "gabriele.romano@example.com",
                "password" => "hgf543",
                "descrizione" => "Appassionato di tecnologia"
            ),
            array(
                "nome" => "Sara",
                "cognome" => "Gallo",
                "data_di_nascita" => "1994-06-27",
                "email" => "sara.gallo@example.com",
                "password" => "fds987",
                "descrizione" => "Amante della lettura"
            ),
            array(
                "nome" => "Davide",
                "cognome" => "Conti",
                "data_di_nascita" => "1987-02-18",
                "email" => "davide.conti@example.com",
                "password" => "rty456",
                "descrizione" => "Appassionato di cucina"
            ),
        ];

        User::factory()->count(50)->create();
    }
}