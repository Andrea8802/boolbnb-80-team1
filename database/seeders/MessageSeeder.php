<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Message;
use App\Models\Apartment;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory()->count(20)->make()->each(function ($m) {
            $apartment = Apartment::inRandomOrder()->first();
            $m->apartment()->associate($apartment);
            $m->save();
        });
    }
}