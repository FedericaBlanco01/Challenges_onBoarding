<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AirlineController;

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

Route::get('/cities', [CityController::class, 'index']);

Route::post('/cities', [CityController::class, 'create'])->name('createcity');


Route::get('/airlines', [AirlineController::class, 'index']);
Route::get('flights/{post:slug}', [FlightController::class, 'show']);

