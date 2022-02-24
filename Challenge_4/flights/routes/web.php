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

Route::get('/airlines', [AirlineController::class, 'index']);
Route::post('/deleteairline', [AirlineController::class, 'delete'])->name('deleteairline');

Route::get('flights/{post:slug}', [FlightController::class, 'show']);

Route::get('ajax-request', [AirlineController::class,'create']);
Route::post('ajax-request', [AirlineController::class,'store']);
