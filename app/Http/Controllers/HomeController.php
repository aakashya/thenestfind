<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::with('cities')->get(); // Fetch all countries with cities
        return view('pages.home', compact('countries')); // Pass to Blade
    }
}

