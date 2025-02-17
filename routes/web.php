<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccommodationDisplayController;
use App\Http\Controllers\LocationDisplayController;

require base_path('routes/api.php');

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/{city}', [LocationDisplayController::class, 'showCity'])
    ->where('city', '[a-zA-Z0-9\-_]+')
    ->name('city.show');


Route::get('/accommodation/{id}', [AccommodationDisplayController::class, 'show'])->name('accommodation.show');

