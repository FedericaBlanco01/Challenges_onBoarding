<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//CRUD CITIES
Route::get('/cities', [CityController::class, 'index']);
Route::post('/cities', [CityController::class, 'store']);
Route::get('/fetchcities', [CityController::class, 'fetch']);
Route::delete('/deleteCity/{id}', [CityController::class, 'destroy']);
Route::get('/editCity/{id}', [CityController::class, 'edit']);
Route::patch('/editCity/{id}', [CityController::class, 'update']);

//CRUD AIRLINES
Route::get('/airlines', [AirlineController::class, 'index']);
Route::get('/fetchairlines', [AirlineController::class, 'fetch']);
Route::post('/airlines', [AirlineController::class, 'store']);
Route::delete('/deleteAirline/{id}', [AirlineController::class, 'destroy']);
Route::get('/editAirline/{id}', [AirlineController::class, 'edit']);
Route::patch('/updateAirline', [AirlineController::class, 'update']);

//CRUD FLIGHTS
Route::get('/flights',[FlightController::class, 'show']);
Route::get('/getflights', [FlightController::class, 'index']);
Route::post('/addflight', [FlightController::class, 'store']);
Route::delete('/deleteFlight/{id}', [FlightController::class, 'destroy']);
//Route::get('/editFlight/{id}', [FlightController::class, 'edit']);
//Route::patch('/updateFlight', [FlightController::class, 'update']);
