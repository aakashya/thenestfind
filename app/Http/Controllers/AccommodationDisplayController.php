<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationDisplayController extends Controller
{
    public function show($country, $city, $slug)
{
    // Extract ID from the end of the slug
    $parts = explode('-', $slug);
    $id = array_pop($parts);

    $accommodation = Accommodation::with('rooms')->findOrFail($id);

    // Decode property photos if needed
    if (is_string($accommodation->property_photos)) {
        $accommodation->property_photos = json_decode($accommodation->property_photos, true);
    }

    foreach ($accommodation->rooms as $room) {
        if (is_string($room->photos)) {
            $room->photos = json_decode($room->photos, true);
        }
    }

    $rooms = $accommodation->rooms;

    return view('pages.accommodation', compact('accommodation', 'rooms'));
}
}

