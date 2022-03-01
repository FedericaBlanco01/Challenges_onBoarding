<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirlineController extends Controller
{
    public function index()
    {
        return view('tables.airlines', [
            'content' => Airline::with('flights')->get()->toArray(),
        ]);
    }

    // public function create(Request $request)
    // {

    //     DB::insert('insert into airlines (name, description) values (?, ?)', [$name, $description]);
    // }
}
