<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Accommodation;
use App\Models\Room;

class AccommodationSeeder extends Seeder
{
    public function run()
    {
        $apiUrl = "https://junehomes.com/api/v1/residences/feeds/coliving/viL8GrIUm3wrOFU/"; // Replace with actual API endpoint
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $accommodations = $response->json();

            foreach ($accommodations as $accommodationData) {
                // Insert accommodation
                $accommodation = Accommodation::updateOrCreate(
                    ['id' => $accommodationData['id']],
                    [
                        'name' => $accommodationData['name'],
                        'url' => $accommodationData['url'] ?? null,
                        'property_type' => $accommodationData['property_type'],
                        'property_size' => $accommodationData['property_size'],
                        'property_size_unit' => $accommodationData['property_size_unit'],
                        'bedrooms' => $accommodationData['bedrooms'],
                        'bathrooms' => $accommodationData['bathrooms'],
                        'residents' => $accommodationData['residents'],
                        'description' => $accommodationData['descriptions']['property'] ?? null,
                        'neighborhood' => $accommodationData['descriptions']['neighborhood'] ?? null,
                        'address' => $accommodationData['location']['address'],
                        'zip' => $accommodationData['location']['zip'] ?? null,
                        'city' => $accommodationData['location']['city'],
                        'state' => $accommodationData['location']['state'],
                        'country' => $accommodationData['location']['country'],
                        'lat' => $accommodationData['location']['lat'],
                        'lng' => $accommodationData['location']['lng'],
                        'amenities' => json_encode($accommodationData['amenities'] ?? []),
                        '3d_tour' => $accommodationData['media']['3d_tour'] ?? null,
                        'property_photos' => json_encode($accommodationData['media']['photos']['property'] ?? []),
                        'check_in_earliest' => $accommodationData['instructions']['check_in_earliest'] ?? null,
                        'check_in_latest' => $accommodationData['instructions']['check_in_latest'] ?? null,
                        'check_in_contact' => $accommodationData['instructions']['check_in_contact_person'] ?? null,
                        'check_in_instructions' => $accommodationData['instructions']['check_in_instructions'] ?? null,
                        'directions' => $accommodationData['instructions']['directions'] ?? null,
                        'house_manual' => $accommodationData['instructions']['house_manual'] ?? null,
                        'check_in_phone_code' => $accommodationData['instructions']['check_in_telephone_country'] ?? null,
                        'check_in_phone_number' => $accommodationData['instructions']['check_in_telephone_number'] ?? null,
                    ]
                );

                // Insert rooms
                foreach ($accommodationData['room_types'] as $roomData) {
                    Room::updateOrCreate(
                        ['id' => $roomData['id']],
                        [
                            'accommodation_id' => $accommodation->id,
                            'name' => $roomData['name'],
                            'room_type' => $roomData['room_type'],
                            'room_size' => $roomData['room_size'],
                            'room_size_unit' => $roomData['room_size_unit'],
                            'max_occupancy' => $roomData['max_occupancy'],
                            'bathroom_type' => $roomData['bathroom_type'],
                            'description' => $roomData['rooms']['description'] ?? null,
                            'prices' => json_encode($roomData['prices'] ?? []),
                            'amenities' => json_encode($roomData['amenities'] ?? []),
                            'available_at' => $roomData['available_at'] ?? null,
                            'photos' => json_encode($roomData['photos'] ?? []),
                            'application_url' => $roomData['application_url'] ?? null,
                        ]
                    );
                }
            }
        } else {
            echo "Error fetching accommodations from API.\n";
        }
    }
}
