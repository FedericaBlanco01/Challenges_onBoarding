<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
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
        $cities = City::factory(10)->create();
        $airlines = Airline::factory(10)->create();

        Flight::factory()->count(5)->sequence(fn ($sequence) => [
            'departure_city_id' => $cities->random()->id,
            'arrival_city_id' => $cities->random()->id,
            'airline_id' => $airlines->random()->id,
        ])->create();
    }
}
