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
            'content' => City::with(['flightsAsArrival','flightsAsDeparture'])->get()->toArray()
        ]);
    }
}

