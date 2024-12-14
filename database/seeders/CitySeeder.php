<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cityArray = ['Poltava', 'Kyiv', 'Kharkiv'];
        foreach ($cityArray as $city) {
            $tasks[] = [
                'name' => $city,
                'created_at' => now(),
                'updated_at' => now(),
            ];

        }

        City::insert($tasks);
    }
}
