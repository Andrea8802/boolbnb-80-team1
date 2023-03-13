<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arraySponsors = [

            [
                "name" => "1 day",
                "price" => 2.99,
                "time" => 24,
            ],
            [
                "name" => "3 days",
                "price" => 5.99,
                "time" => 72,
            ],
            [
                "name" => "6 days",
                "price" => 9.99,
                "time" => 144,
            ],

        ];

        // Sponsor::create($arraySponsors);
        foreach ($arraySponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}