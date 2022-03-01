<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('tables.cities', [
            'content' => City::with(['flightsAsArrival', 'flightsAsDeparture'])->get()->toArray(),
        ]);
    }

    public function fetch()
    {
        $cities = City::withCount(['flightsAsArrival', 'flightsAsDeparture'])->get();

        return response()->json([
            'cities'=>$cities,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique|max:191']);
        $city = new City(['name'=>$request->input('name')]);
        $city->save();

        return response()->json([
            'status' => 200,
            'message' => 'City added successfully',
            'city'=> $city,
        ]);
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();

        return response()->json([
            'status' => 200,
            'message' => 'City deleted successfully',
        ]);
    }

    public function edit(Request $request)
    {
        $city = City::find($request->input('id'));

        return response()->json([
            'status' => 200,
            'city'=> $city,
        ]);
    }
}
