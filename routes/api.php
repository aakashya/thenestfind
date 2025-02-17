<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\City;

// Manually add the "/api" prefix
Route::prefix('api')->group(function () {
    Route::get('/cities', function (Request $request) {
        if (!$request->has('country_id')) {
            return response()->json(['error' => 'Missing country_id'], 400);
        }

        return response()->json(City::where('country_id', $request->country_id)->get());
    });
});



