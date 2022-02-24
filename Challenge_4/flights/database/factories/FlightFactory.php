<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\City;
use App\Models\Available;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'airline_id'=> Airline::factory(),
            'departure_city_id'=> City::factory(),
            'arrival_city_id'=> City::factory(),
            'departure_time'=> $this->faker->dateTime(),
            'arrival_time'=> $this->faker->dateTime()
        ];
    }
}
