<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function show()
    {
        $airlines = Airline::with('availableCities')->get()->toArray();

        return view('tables.flights', ['airlines' => $airlines]);
    }

    public function index()
    {
        $flights = Flight::with(['airline', 'departure_city', 'arrival_city'])->get();

        return response()->json(['flights' => $flights]);
    }

    public function store(Request $request)
    {
        $departure_time = $request->input('departure_time');
        $now = date_default_timezone_get();

        $request->validate(['airline_id' => 'required',
            'departure_city_id' => 'required',
            'arrival_city_id' => 'required|different:departure_city_id',
            'departure_time' => 'required|date|after:'.$now,
            'arrival_time' => 'required|date|after:'.$departure_time,
        ]);

        $flight = new Flight([
            'airline_id' => $request->input('airline_id'),
            'departure_city_id' => $request->input('departure_city_id'),
            'arrival_city_id' => $request->input('arrival_city_id'),
            'departure_time' => $departure_time,
            'arrival_time' => $request->input('arrival_time'),
        ]);
        $flight->save();

        return response()->json([
            'message' => 'Flight created successfully!',
            'new_flight' => $flight,
        ]);
    }

    public function getValuesFromFlight($id)
    {
        $flight = Flight::find($id);
        $airline = Airline::with('availableCities')->find($flight->airline_id);
        $departure = City::find($flight->departure_city_id);
        $arrival = City::find($flight->arrival_city_id);
        $departureTime = $flight->departure_time;
        $arrivalTime = $flight->arrival_time;

        return response()->json([
            'airline' => $airline,
            'departure' => $departure,
            'arrival' => $arrival,
            'departureTime' => $departureTime,
            'arrivalTime' => $arrivalTime,
        ]);
    }

    public function update(Request $request)
    {
        $departure_time = $request->input('departure_time');
        $now = date_default_timezone_get();

        $request->validate(['airline_id' => 'required',
            'departure_city_id' => 'required',
            'arrival_city_id' => 'required|different:departure_city_id',
            'departure_time' => 'required|date|after:'.$now,
            'arrival_time' => 'required|date|after:'.$departure_time,
        ]);

        $flight = Flight::find($request->input('flight_id'));
        $flight->airline_id = $request->input('airline_id');
        $flight->departure_city_id = $request->input('departure_city_id');
        $flight->arrival_city_id = $request->input('arrival_city_id');
        $flight->departure_time = $departure_time;
        $flight->arrival_time = $request->input('arrival_time');
        $flight->save();

        return response()->json([
            'status' => 200,
            'message' => 'Flight updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $flight = Flight::find($id);
        $flight->delete();

        return response()->json('Flight deleted successfully!');
    }
}
