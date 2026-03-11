<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Accommodation;
use App\Models\Room;
use SimpleXMLElement;

class JuneHomeSeeder extends Seeder
{
    /**
     * Map provider/source accommodation ids to a stable numeric id compatible
     * with accommodations.id (BIGINT UNSIGNED).
     */
    private function mapAccommodationId(string|int $originalId, string $providerPrefix = '6000'): int
    {
        $id = (string) $originalId;

        if (ctype_digit($id)) {
            return (int) ($providerPrefix . $id);
        }

        $providerBase = ((int) $providerPrefix) * 1000000000;
        $hash = (int) sprintf('%u', crc32($providerPrefix . '|' . $id));

        return $providerBase + $hash;
    }

    public function run()
    {
        $jsonApiUrl = "https://junehomes.com/api/v1/residences/feeds/coliving/viL8GrIUm3wrOFU/";
        $jsonResponse = Http::get($jsonApiUrl);

        $xmlApiUrl = "https://junehomes.com/api/v1/residences/feeds/hotpads-official/rOvgiL8GFUIOgUm3wLfy/";
        $xmlResponse = Http::get($xmlApiUrl);

        if ($jsonResponse->successful() && $xmlResponse->successful()) {
            $accommodationsJson = $jsonResponse->json();
            $accommodationsXml = new SimpleXMLElement($xmlResponse->body());

            $providerPrefix = '6000';
            $apiAccommodationIds = collect($accommodationsJson)
                ->pluck('id')
                ->map(fn($id) => $this->mapAccommodationId($id, $providerPrefix))
                ->toArray();

            $existingAccommodationIds = Accommodation::where('provider', 'June Homes')->pluck('id')->toArray();
            $accommodationsToDelete = array_diff($existingAccommodationIds, $apiAccommodationIds);

            if (!empty($accommodationsToDelete)) {
                $this->command->warn("Deleting removed accommodations: " . implode(', ', $accommodationsToDelete));
                Accommodation::whereIn('id', $accommodationsToDelete)->delete();
            }

            $xmlRooms = [];
            foreach ($accommodationsXml->Listing as $listing) {
                $systemName = (string) $listing->systemName;
                $xmlRooms[$systemName] = [
                    'id' => $systemName,
                    'price' => (int) $listing->price,
                    'unit' => (string) $listing->unit,
                    'description' => (string) $listing->description,
                    'private_bathroom' => (string) $listing->privateBathroom === 'True' ? 1 : 0,
                    'number_of_roommates' => (int) $listing->numberOfRoommates,
                    'live_in_partner_allowed' => (string) $listing->liveInPartnerAllowed === 'True' ? 1 : 0,
                    'fully_furnished' => (string) $listing->isFurnished === 'True' ? 1 : 0,
                    'price_frequency' => (string) $listing->priceFrequency,
                    'terms' => (string) $listing->terms,
                    'room_info' => (string) $listing->name,
                    'room_url' => (string) $listing->website,
                    'virtual_tour_url' => (string) $listing->virtualTourUrl,
                    'amenities' => [],
                    'street' => (string) $listing->street,
                ];

                foreach ($listing->ListingTag as $tag) {
                    $xmlRooms[$systemName]['amenities'][] = (string) $tag->tag;
                }
            }

            foreach ($accommodationsJson as $accommodationData) {
                $originalId = $accommodationData['id'];
                $customId = $this->mapAccommodationId($originalId, $providerPrefix);

                $this->command->info("Processing accommodation: " . $accommodationData['name']);

                $accommodation = Accommodation::updateOrCreate(
                    ['id' => $customId],
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
                        'terms' => collect($xmlRooms)
                            ->filter(fn($room) => $originalId === explode('#', $room['id'])[0])
                            ->pluck('terms')
                            ->unique()
                            ->implode(', '),
                        'street' => collect($xmlRooms)
                            ->filter(fn($room) => $originalId === explode('#', $room['id'])[0])
                            ->pluck('street')
                            ->first() ?? $accommodationData['location']['address'] ?? null,
                        'provider' => 'June Homes',
                    ]
                );

                $apiRoomIds = collect($accommodationData['room_types'])->pluck('id')->toArray();
                $existingRoomIds = Room::where('accommodation_id', $customId)->pluck('id')->toArray();

                $roomsToDelete = array_diff($existingRoomIds, $apiRoomIds);
                if (!empty($roomsToDelete)) {
                    $this->command->warn(" - Deleting removed rooms: " . implode(', ', $roomsToDelete));
                    Room::whereIn('id', $roomsToDelete)->delete();
                }

                foreach ($accommodationData['room_types'] as $roomData) {
                    $systemName = $roomData['id'];
                    if (isset($xmlRooms[$systemName])) {
                        $this->command->info(" - Adding room: " . $roomData['name']);

                        Room::updateOrCreate(
                            ['id' => $systemName],
                            [
                                'accommodation_id' => $customId,
                                'name' => $roomData['name'] ?? $xmlRooms[$systemName]['room_info'] ?? 'Unknown Room',
                                'price' => $xmlRooms[$systemName]['price'],
                                'photos' => json_encode($roomData['photos'] ?? []),
                                'unit' => $xmlRooms[$systemName]['unit'],
                                'description' => $xmlRooms[$systemName]['description'],
                                'private_bathroom' => $xmlRooms[$systemName]['private_bathroom'],
                                'private_kitchen' => 0,
                                'number_of_roommates' => $xmlRooms[$systemName]['number_of_roommates'],
                                'live_in_partner_allowed' => $xmlRooms[$systemName]['live_in_partner_allowed'],
                                'fully_furnished' => $xmlRooms[$systemName]['fully_furnished'],
                                'price_frequency' => $xmlRooms[$systemName]['price_frequency'],
                                'terms' => $xmlRooms[$systemName]['terms'],
                                'room_info' => $xmlRooms[$systemName]['room_info'],
                                'room_url' => $xmlRooms[$systemName]['room_url'],
                                'room_type' => $roomData['room_type'],
                                'room_size' => $roomData['room_size'],
                                'room_size_unit' => $roomData['room_size_unit'] ?? null,
                                'max_occupancy' => $roomData['max_occupancy'] ?? null,
                                'bathroom_type' => $roomData['bathroom_type'] ?? null,
                                'virtual_tour_url' => $xmlRooms[$systemName]['virtual_tour_url'] ?? null,
                                'amenities' => json_encode($xmlRooms[$systemName]['amenities']),
                                'available_at' => $roomData['available_at'] ?? null,
                                'application_url' => $roomData['application_url'] ?? null,
                                'provider' => 'June Homes',
                            ]
                        );
                    }
                }
            }
        } else {
            echo "Error fetching accommodations from APIs.\n";
        }
    }
}
