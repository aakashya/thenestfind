<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccommodationDisplayController;
use App\Http\Controllers\LocationDisplayController;
use App\Http\Controllers\FormSubmissionController;

Route::get('/accommodation/{country}/{city}/{slug}', [AccommodationDisplayController::class, 'show'])->name('accommodation.show');



Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/{city}', [LocationDisplayController::class, 'showCity'])->where('city', '[a-zA-Z0-9\-_]+')->name('city.show');





// Helper function to serve static HTML files
function serveStaticPage($folder, $page) {
    $path = resource_path("static/{$folder}/{$page}.html");

    if (file_exists($path)) {
        return response()->file($path);
    }

    abort(404); // Return 404 if file does not exist
}

// 1️⃣ Accommodations Pages → /accommodations/{page}
Route::get('/accommodations/{page}', function ($page) {
    return serveStaticPage('accommodations', $page);
})->where('page', '[A-Za-z0-9_-]+');

// 2️⃣ Blog Pages → /blog/{page}
Route::get('/blog/{page}', function ($page) {
    return serveStaticPage('blog', $page);
})->where('page', '[A-Za-z0-9_-]+');

// 3️⃣ City Pages → /city/{city-name}
Route::get('/city/{page}', function ($page) {
    return serveStaticPage('city', $page);
})->where('page', '[A-Za-z0-9_-]+');

// 4️⃣ Other Pages → /static/{page}
Route::get('/static/{page}', function ($page) {
    return serveStaticPage('other', $page);
})->where('page', '[A-Za-z0-9_-]+');


Route::post('/form-submit', [FormSubmissionController::class, 'submit'])
    ->middleware('throttle:20,1')
    ->name('form.submit');


Route::redirect('/aboutus', '/static/about', 301);
