<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/reservation', [TicketController::class, 'reserveTicketForm'])->name('reserveTicketForm');
Route::post('/reserve-ticket', [TicketController::class, 'reserveTicket'])->name('reserveTicket');
Route::get('/search-flight', [FlightController::class, 'flightSearchForm'])->name('flightSearchForm');
Route::post('/flight-search', [FlightController::class, 'showFlightInformation'])->name('flightSearch');
Route::resource('/flights', FlightController::class);