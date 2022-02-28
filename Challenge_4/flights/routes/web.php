<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AirlineController;
use App\Models\City;

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

Route::get('/', function () {return view('home');});

//CRUD CITIES
Route::get('/cities', [CityController::class, 'index']);
Route::post('/cities', [CityController::class, 'store']);
Route::get('/fetchcities', [CityController::class, 'fetch']);

Route::get('/click_delete/{id}', [CityController::class, 'delete']);
Route::get('/click_update/{name}', function(City $city){return view('components.updateCity',[
    'city'=>$city
]);});

Route::get('/airlines', [AirlineController::class, 'index']);

