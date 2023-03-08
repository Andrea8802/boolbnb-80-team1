<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Statistic;
use App\Models\Apartment;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statistic::factory()->count(20)->make()->each(function ($stats) {
            $apartment = Apartment::inRandomOrder()->first();
            $stats->apartment()->associate($apartment);
            $stats->save();
        });
    }
}