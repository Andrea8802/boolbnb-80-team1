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
        $arrayUsers = [
            array(
                "name" => "Marco",
                "surname" => "Rossi",
                "date_of_birth" => "1985-07-10",
                "email" => "marco.rossi@example.com",
                "password" => "P4ssw0rd!",
                "description" => "Appassionato di calcio e viaggi."
            ),
            array(
                "name" => "Francesca",
                "surname" => "Verdi",
                "date_of_birth" => "1990-04-23",
                "email" => "francesca.verdi@example.com",
                "password" => "S3cr3t!",
                "description" => "Amante dell'arte e della natura."
            ),
            array(
                "name" => "Giovanni",
                "surname" => "Bianchi",
                "date_of_birth" => "1978-12-01",
                "email" => "giovanni.bianchi@example.com",
                "password" => "P@ssword",
                "description" => "Fervente tifoso della squadra del cuore."
            ),
            array(
                "name" => "Chiara",
                "surname" => "Neri",
                "date_of_birth" => "1989-06-15",
                "email" => "chiara.neri@example.com",
                "password" => "Passw0rd!",
                "description" => "Appassionata di cinema e musica."
            ),
            array(
                "name" => "Alessandro",
                "surname" => "Marrone",
                "date_of_birth" => "1983-03-28",
                "email" => "alessandro.marrone@example.com",
                "password" => "Secret1",
                "description" => "Viaggiatore instancabile e buongustaio."
            ),
            array(
                "name" => "Martina",
                "surname" => "Russo",
                "date_of_birth" => "1995-09-07",
                "email" => "martina.russo@example.com",
                "password" => "MyPassw0rd",
                "description" => "Sportiva appassionata di trekking e yoga."
            ),
            array(
                "name" => "Paolo",
                "surname" => "Romano",
                "date_of_birth" => "1975-11-12",
                "email" => "paolo.romano@example.com",
                "password" => "Passw0rd123",
                "description" => "Esperto di finanza e investimenti."
            ),
            array(
                "name" => "Simona",
                "surname" => "Ferrari",
                "date_of_birth" => "1991-02-18",
                "email" => "simona.ferrari@example.com",
                "password" => "MyS3cr3t",
                "description" => "Amante della natura e della fotografia."
            ),
            array(
                "name" => "Chiara",
                "surname" => "Ferragni",
                "date_of_birth" => "1987-05-07",
                "email" => "chiara.ferragni@example.com",
                "password" => "MyS3cr3t",
                "description" => "Mi piace la moda e le belle case."
            ),
            array(
                "name" => "Shakira",
                "surname" => "Mebarak",
                "date_of_birth" => "1977-02-02",
                "email" => "shakira.mebarak@example.com",
                "password" => "MyS3cr3t",
                "description" => "Mi piace la twingo e gli orologi casio."
            ),
            array(
                "name" => "Massimo",
                "surname" => "Pezzali",
                "date_of_birth" => "1967-11-14",
                "email" => "massimo.pezzali@example.com",
                "password" => "MyS3cr3t",
                "description" => "Mi piace viaggiare da nord a sud e da est a ovest."
            ),
            array(
                "name" => "Leonardo",
                "surname" => "Da Vinci",
                "date_of_birth" => "1980-04-15",
                "email" => "leonardo.davinci@example.com",
                "password" => "MyS3cr3t",
                "description" => "Sono semplicemente un genio molto modesto."
            ),
            array(
                "name" => "Dante",
                "surname" => "Alighieri",
                "date_of_birth" => "1985-09-14",
                "email" => "dante.alighieri@example.com",
                "password" => "MyS3cr3t",
                "description" => "Amo la poesia e ho scritto anche delle mie opere"
            ),
            array(
                "name" => "Renato",
                "surname" => "Fiacchini",
                "date_of_birth" => "1950-09-30",
                "email" => "renato.zero@example.com",
                "password" => "MyS3cr3t",
                "description" => "Sono un catautore e ho anche doppiato il personaggio di un film di Tim Burton"
            ),
            array(
                "name" => "Roberto",
                "surname" => "Benigni",
                "date_of_birth" => "1952-10-27",
                "email" => "roberto.benigni@example.com",
                "password" => "MyS3cr3t",
                "description" => "Sono un attore e un grande simpaticone."
            ),
        ];

        // User::factory()->count(50)->create();
        foreach ($arrayUsers as $user) {
            User::create($user);
        }
    }
}