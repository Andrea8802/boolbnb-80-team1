<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SponsorSeeder::class,
            ServiceSeeder::class,
            UserSeeder::class,
            ApartmentSeeder::class,
            StatisticSeeder::class,
            MessageSeeder::class,
            AddedImageSeeder::class,
        ]);
    }
}