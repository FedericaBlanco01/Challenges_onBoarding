<?php

namespace Tests\Feature;

use App\Http\Controllers\FlightController;
use App\Models\Airline;
use App\Models\Flight;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_flight_from_db()
    {
        $this->withoutExceptionHandling();
        $flights = Flight::factory()->create();
        $route = '/deleteFlight/' . $flights->id;
        $response = $this->call('DELETE', $route);
        $this->assertEquals(200, $response->status());
    }

    public function test_existing_flight_update()
    {
        City::factory()->count(2)->sequence(
            ['id'=>1],
            ['id'=>2],
        )->create();
        Airline::factory()->count(2)->sequence(
            ['id'=>1],
            ['id'=>2],
        )->create();
        $flight = Flight::factory()->create([
            'id' => 1,
            "airline_id" => 1,]);

        $route = '/updateflight';
        $response = $this->call('PATCH', $route, [
            'flight_id' => 1,
            'airline_id' => 2,
            'departure_city_id' => 1,
            'arrival_city_id' => 2,
            'departure_time' => '2022-12-12 07:16:11.0',
            'arrival_time' => '2022-12-13 00:10:17.0']);

        $this->assertDatabaseMissing('flights',[
            'airline_id' => 1,
            ]);

    }

    public function test_add_new_flight_to_db(){
        City::factory()->count(2)->sequence(
            ['id'=>1],
            ['id'=>2],
        )->create();
        Airline::factory()->sequence(
            ['id'=>1],
        )->create();

        $route = '/addflight';
        $response = $this->call('POST', $route,[
            'airline_id' => 1,
            'departure_city_id' => 1,
            'arrival_city_id' => 2,
            'departure_time' => '2022-12-12 07:16:11.0',
            'arrival_time' => '2022-12-13 00:10:17.0']);

        $this->assertDatabaseHas('flights',[
            'airline_id' => 1,
            'departure_city_id' => 1,
            'arrival_city_id' => 2,
            'departure_time' => '2022-12-12 07:16:11.0',
            'arrival_time' => '2022-12-13 00:10:17.0']);
    }

    public function test_table_flights_displayed(){
        $this->withoutExceptionHandling();
        Flight::factory()->count(10)->create();
        $route = '/getflights';
        $this->call('GET', $route)
            ->assertSuccessful()
            ->assertJson(function(AssertableJson $json){
                $json->has('flights',10);
            });

    }
    


}
