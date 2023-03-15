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
        Apartment::factory()->count(20)->make()->each(function ($ap) {
            $user = User::inRandomOrder()->first();
            $ap->user()->associate($user);
            $ap->save();
            $services = Service::inRandomOrder()->limit(rand(1, 3))->get();
            $ap->services()->attach($services);
            // $sponsor = Sponsor::inRandomOrder()->first()->get();
            // $ap->sponsors()->attach($sponsor);
        });
    }
}