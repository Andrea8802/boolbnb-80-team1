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
                "data_di_nascita" => "1985-07-10",
                "email" => "marco.rossi@example.com",
                "password" => "P4ssw0rd!",
                "descrizione" => "Appassionato di calcio e viaggi."
            ),
            array(
                "nome" => "Francesca",
                "cognome" => "Verdi",
                "data_di_nascita" => "1990-04-23",
                "email" => "francesca.verdi@example.com",
                "password" => "S3cr3t!",
                "descrizione" => "Amante dell'arte e della natura."
            ),
            array(
                "nome" => "Giovanni",
                "cognome" => "Bianchi",
                "data_di_nascita" => "1978-12-01",
                "email" => "giovanni.bianchi@example.com",
                "password" => "P@ssword",
                "descrizione" => "Fervente tifoso della squadra del cuore."
            ),
            array(
                "nome" => "Chiara",
                "cognome" => "Neri",
                "data_di_nascita" => "1989-06-15",
                "email" => "chiara.neri@example.com",
                "password" => "Passw0rd!",
                "descrizione" => "Appassionata di cinema e musica."
            ),
            array(
                "nome" => "Alessandro",
                "cognome" => "Marrone",
                "data_di_nascita" => "1983-03-28",
                "email" => "alessandro.marrone@example.com",
                "password" => "Secret1",
                "descrizione" => "Viaggiatore instancabile e buongustaio."
            ),
            array(
                "nome" => "Martina",
                "cognome" => "Russo",
                "data_di_nascita" => "1995-09-07",
                "email" => "martina.russo@example.com",
                "password" => "MyPassw0rd",
                "descrizione" => "Sportiva appassionata di trekking e yoga."
            ),
            array(
                "nome" => "Paolo",
                "cognome" => "Romano",
                "data_di_nascita" => "1975-11-12",
                "email" => "paolo.romano@example.com",
                "password" => "Passw0rd123",
                "descrizione" => "Esperto di finanza e investimenti."
            ),
            array(
                "nome" => "Simona",
                "cognome" => "Ferrari",
                "data_di_nascita" => "1991-02-18",
                "email" => "simona.ferrari@example.com",
                "password" => "MyS3cr3t",
                "descrizione" => "Amante della natura e della fotografia."
            ),
        ];

        User::factory()->count(50)->create();
    }
}