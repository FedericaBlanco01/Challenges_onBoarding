<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
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
Route::post('/editCity/{id}', [CityController::class, 'edit']);

Route::get('/airlines', [AirlineController::class, 'index']);
