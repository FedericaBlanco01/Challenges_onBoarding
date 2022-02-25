<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        return view('tables.cities', [
            'content' => City::with(['flightsAsArrival', 'flightsAsDeparture'])->get()->toArray()
        ]);
    }

    public function create()
    {
        DB::insert('insert into cities (name) values (?)', [$_REQUEST['input_city']]);
        return view('tables.cities', [
            'content' => City::with(['flightsAsArrival', 'flightsAsDeparture'])->get()->toArray()
        ]);
    }

    public function delete()
    {
        if (isset($_REQUEST['deleteButton'])) {
            $deleted = DB::delete('delete from users');
        }

        return view('tables.cities', [
            'content' => City::with(['flightsAsArrival', 'flightsAsDeparture'])->get()->toArray()
        ]);
    }
}
