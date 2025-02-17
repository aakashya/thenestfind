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
            "US" => ["New York", "Los Angeles", "Chicago", "Austin", "Washington DC", "Houston", "Boston", "San Francisco", "Dallas", "Philadelphia", "Miami", "Minneapolis"],
            "AUS" => ["Sydney", "Melbourne", "Brisbane", "Canberra", "Perth", "Gold Coast", "Adelaide"]
        ];

        foreach ($countryCities as $code => $cities) {
            // Insert country
            $country = Country::firstOrCreate([
                'country_code' => $code,
            ], [
                'country_name' => $this->getCountryName($code),
                'image' => "/images/countries/{$code}.png" // Assuming images are stored like UK.png
            ]);

            // Insert cities for this country
            foreach ($cities as $city) {
                City::firstOrCreate([
                    'city_name' => $city,
                    'slug' => strtolower(str_replace(' ', '-', $city)),
                    'country_id' => $country->id,
                    'status' => in_array($city, $this->comingSoonCities()) ? 'coming_soon' : 'available',
                    'image' => "/images/cities/" . strtolower(str_replace(' ', '-', $city)) . ".webp"
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

    // Helper function to mark some cities as "coming soon"
    private function comingSoonCities()
    {
        return ["Belfast", "Bristol", "Cardiff", "Coventry", "Exeter", "Glasgow", "Liverpool", "New Castle", "Nottingham", "Southampton", "York", "New York", "Los Angeles", "Chicago", "Austin", "Washington DC", "Houston", "Boston", "San Francisco", "Dallas", "Philadelphia", "Miami", "Minneapolis", "Sydney", "Melbourne", "Brisbane", "Canberra", "Perth", "Gold Coast", "Adelaide"];
    }
}
