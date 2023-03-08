<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayServices = ['Pool', 'Kitchen', 'Parking', 'Shampoo', 'Freezer', 'Balcony', 'Hammock', 'Tv', 'Air conditioning', 'Lockbox', 'Private sauna', 'BBQ grill', 'Coffee', 'Stove', 'Freezer', 'Refrigerator', 'Smoke alarm', 'Lake view', 'Sea view', 'Ocean view', 'Hangers'];
        foreach ($arrayServices as $service) {
            Service::create(
                [
                    'name' => $service,
                ]
            );
        }
    }
}