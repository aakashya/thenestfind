<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;

require base_path('routes/api.php');

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/city/{name}', function ($name) {
    return view('cities.show', ['city' => $name]);
})->name('city');


