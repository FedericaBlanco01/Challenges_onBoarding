<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        return view('tables.cities', [
            'content' => City::with(['flightsAsArrival', 'flightsAsDeparture'])->get()->toArray()
        ]);
    }

    public function fetch()
    {
        $cities= City::withCount(['flightsAsArrival', 'flightsAsDeparture'])->get();

        return response()->json([
            'cities'=>$cities
        ]);
    }

    public function store(Request $request)
    {

        $request->validate(['name' => 'required|max:191']);
        $city= new City(['name'=>$request->input('name')]);
        $city->save();
        return response()->json([
            'status' => 200,
            'message' => 'City added successfully',
            'city'=> $city
        ]);

    }

    public function delete($id)
    {

        $deleted = DB::delete('delete from flights where arrival_city_id=?', [$id]);
        $deleted = DB::delete('delete from flights where departure_city_id=?', [$id]);
        $deleted = DB::delete('delete from cities where id=?', [$id]);

        return redirect('/cities')->with('success', 'Data got deleted');
    }

    public function edit(City $city)
    {
        return view('components.updateCity', compact('city'));
    }
}
