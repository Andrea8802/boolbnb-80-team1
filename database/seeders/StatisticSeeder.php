<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Apartment;
use App\Models\Statistic;


class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indirizziIP = [
            "192.168.0.1",
            "10.0.0.1",
            "172.16.0.1",
            "192.168.1.1",
            "192.168.2.1",
            "192.168.3.1",
            "192.168.4.1",
            "192.168.5.1",
            "192.168.6.1",
            "192.168.7.1",
            "192.168.8.1",
            "192.168.9.1",
            "192.168.10.1",
            "192.168.11.1",
            "192.168.12.1",
            "192.168.13.1",
            "192.168.14.1",
            "192.168.15.1",
            "192.168.16.1",
            "192.168.17.1",
            "192.168.18.1",
            "192.168.19.1",
            "192.168.20.1",
            "192.168.21.1",
            "192.168.22.1",
            "192.168.23.1",
            "192.168.24.1",
            "192.168.25.1",
            "192.168.26.1",
            "192.168.27.1",
            "192.168.28.1",
            "192.168.29.1",
            "192.168.30.1",
            "192.168.31.1",
            "192.168.32.1",
            "192.168.33.1",
            "192.168.34.1",
            "192.168.35.1",
            "192.168.36.1",
            "192.168.37.1",
            "192.168.38.1",
            "192.168.39.1",
            "192.168.40.1",
            "192.168.41.1",
            "192.168.42.1",
            "192.168.43.1",
            "192.168.44.1",
            "192.168.45.1",
            "192.168.46.1",
            "192.168.47.1",
            "192.168.48.1",
            "192.168.49.1",
            "192.168.50.1"
        ];

        foreach ($indirizziIP as $indirizzo) {
            Statistic::make([
                'ip_address' => $indirizzo,
            ])->each(function ($stat) {
                $apartment = Apartment::inRandomOrder()->first();
                $stat->apartment()->associate($apartment);
                $stat->save();
            });
        }




        /* Statistic::factory()->count(50)->make()->each(function ($stats) {
        $apartment = Apartment::inRandomOrder()->first();
        $stats->apartment()->associate($apartment);
        $stats->save();
        }); */
    }
}