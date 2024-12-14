<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $qualityArray = ['Premium', 'Middle', 'Low'];
        $departureCities = City::all()->pluck('id');
        $startDate = strtotime(date('Y-m-d 00:00:00'));
        $endDate = strtotime(date('Y-m-29 23:59:59'));

        $currentTime = $startDate;
        $vehicles = [];

        for ($i = 0; $i < 1000; $i++) {
            $departure_city_id = $departureCities->random();
            $destination_city_id = $departureCities->except([$departure_city_id])->random();

            $vehicles[] = [
                'quality' => $qualityArray[array_rand($qualityArray)],
                'departure_city_id' => $departure_city_id,
                'destination_city_id' => $destination_city_id,
                'seats_quantity' => rand(10, 20),
                'ticket_cost' => rand(100, 1000),
                'departure_time' => date('Y-m-d H:i:s', $startDate),
            ];
        }
        Vehicle::insert($vehicles);

    }
}
