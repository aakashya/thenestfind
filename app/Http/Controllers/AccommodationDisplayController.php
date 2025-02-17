<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationDisplayController extends Controller
{
    public function show($id)
    {
        $accommodation = Accommodation::with('rooms')->findOrFail($id);

        // Ensure JSON decoding for property photos
        if (is_string($accommodation->property_photos)) {
            $accommodation->property_photos = json_decode($accommodation->property_photos, true);
        }

        foreach ($accommodation->rooms as $room) {
            // Decode photos field
            if (is_string($room->photos)) {
                $room->photos = json_decode($room->photos, true);
            }
        }

        // Pass the rooms separately to avoid "Undefined variable $rooms" in Blade
        $rooms = $accommodation->rooms;

        return view('pages.accommodation', compact('accommodation', 'rooms'));
    }
}

