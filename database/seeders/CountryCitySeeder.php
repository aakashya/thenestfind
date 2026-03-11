<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;

class CountryCitySeeder extends Seeder
{
    public function run()
    {
        $countryCities = [
            "UK" => ["London", "Leeds", "Manchester", "Birmingham", "Brighton", "Edinburgh", "Belfast", "Bristol", "Cardiff", "Coventry", "Exeter", "Glasgow", "Liverpool", "New Castle", "Nottingham", "Sheffield", "Southampton", "York"],
            "IRE" => ["Dublin"],
            "US" => ["New York", "Jersey City", "Los Angeles", "Chicago", "Austin", "Washington DC", "Houston", "Boston", "San Francisco", "Dallas", "Philadelphia", "Miami", "Minneapolis"],
            "AUS" => ["Sydney", "Melbourne", "Brisbane", "Canberra", "Perth", "Gold Coast", "Adelaide"]
        ];

        foreach ($countryCities as $code => $cities) {
            $country = Country::updateOrCreate([
                'country_code' => $code,
            ], [
                'country_name' => $this->getCountryName($code),
                'image' => "/images/countries/{$code}.png",
            ]);

            foreach ($cities as $city) {
                $slug = strtolower(str_replace(' ', '-', $city));

                City::updateOrCreate([
                    'slug' => strtolower(str_replace(' ', '-', $city)),
                    'country_id' => $country->id,
                ], [
                    'city_name' => $city,
                    'status' => 'available',
                    'image' => "/images/cities/{$slug}.webp",
                ]);
            }
        }
    }

    // Helper function to get full country name
    private function getCountryName($code)
    {
        $countryNames = [
            "UK" => "United Kingdom",
            "IRE" => "Ireland",
            "US" => "United States",
            "AUS" => "Australia"
        ];
        return $countryNames[$code] ?? $code;
    }
}
