<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AddedImage;
use App\Models\Apartment;

class AddedImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddedImage::factory()->count(35)->make()->each(function ($img) {
            $apartment = Apartment::inRandomOrder()->first();
            $img->apartment()->associate($apartment);
            $img->save();
        });
    }
}