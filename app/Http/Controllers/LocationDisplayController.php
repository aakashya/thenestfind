<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Accommodation;

class LocationDisplayController extends Controller
{
    public function showCity($slug)
    {
        // Find the city where status = 'available'
        $city = City::where('slug', $slug)->where('status', 'available')->first();

        if (!$city) {
            abort(404, 'City not found');
        }

        // Use paginate() to get 6 accommodations per page
        $accommodations = Accommodation::where('city', $city->city_name)
            ->paginate(6);

        // Transform each accommodation in the paginator
        $accommodations->setCollection(
            $accommodations->getCollection()->map(function ($accommodation) {
                // Decode property_photos if needed
                $propertyPhotos = is_string($accommodation->property_photos)
                    ? json_decode($accommodation->property_photos, true)
                    : $accommodation->property_photos;

                if (!is_array($propertyPhotos)) {
                    $propertyPhotos = [];
                }

                // Get the last image from the array (if available)
                $coverImage = '';
                if (!empty($propertyPhotos)) {
                    $firstPhoto = reset($propertyPhotos);
                if (is_array($firstPhoto) && isset($firstPhoto['link'])) {
                        $coverImage = $firstPhoto['link'];
                } elseif (is_string($firstPhoto)) {
                         $coverImage = $firstPhoto;
                    }
                }


                // Extract lowest price from rooms JSON column
                $basePrices = collect(json_decode($accommodation->rooms, true))->map(function ($room) {
                    $prices = json_decode($room['prices'], true);
                    return $prices['base_price'] ?? null;
                })->filter()->toArray();

                $lowestPrice = !empty($basePrices) ? min($basePrices) : null;

                return (object) [
                    'id'              => $accommodation->id,
                    'name'            => $accommodation->name,
                    'partner'         => $accommodation->partner,
                    'address'         => $accommodation->address,
                    'city'            => $accommodation->city,
                    'country'         => $accommodation->country,
                    'property_photos' => $propertyPhotos,
                    'cover_image'     => $coverImage,
                    'lowest_price'    => $lowestPrice
                ];
            })
        );

        return view('pages.location', [
            'city' => $city->city_name,
            'accommodations' => $accommodations,
        ]);
    }
}










