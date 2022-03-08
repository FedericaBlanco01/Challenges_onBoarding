<?php

namespace App\Http\Controllers;

class FlightController extends Controller
{
    public function index()
    {
        return view('tables.flights');
    }
}
