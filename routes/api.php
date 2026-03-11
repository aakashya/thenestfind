<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\City;

Route::get('/cities', function (Request $request) {
    $validated = $request->validate([
        'country_id' => 'required|integer|exists:countries,id',
    ]);

    return response()->json(
        City::where('country_id', $validated['country_id'])->get()
    );
});
