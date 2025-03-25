<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\Accommodation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormSubmissionController extends Controller
{
    public function submit(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'nullable|string|max:10',
            'phone_number' => 'required|string|max:20',
            'accommodation_id' => 'required|string',
            'room_id' => 'nullable|string', // Allow empty for general enquiries
            'submission_url' => 'required|string',
        ]);

        // Fetch Accommodation Details
        $accommodation = Accommodation::findOrFail($validated['accommodation_id']);
        $provider = $accommodation->provider;
        $accommodationName = $accommodation->name;

        // Fetch Room Details (if applicable)
        $roomName = null;
        $roomDuration = null;
        $roomPrice = null;

        if (!empty($validated['room_id'])) {
            $room = Room::find($validated['room_id']);

            if ($room) {
                $roomName = $room->name;
                $roomDuration = $room->duration;
                $roomPrice = $room->base_price;
            }
        }

        // Store form submission
        $formSubmission = FormSubmission::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'country_code' => $validated['country_code'],
            'phone_number' => $validated['phone_number'],
            'accommodation_id' => $validated['accommodation_id'],
            'accommodation_name' => $accommodationName,
            'provider' => $provider,
            'room_name' => $roomName,
            'room_duration' => $roomDuration,
            'room_price' => $roomPrice,
            'submission_url' => $validated['submission_url'],
        ]);

        // **Trigger Lead API ONLY if provider is "June Homes"**
        if ($provider === 'June Homes') {
            $this->sendLeadToJuneHomes($formSubmission);
        }

        return redirect()->back();
    }

    /**
     * Send Lead to June Homes API
     */
    private function sendLeadToJuneHomes($formSubmission)
    {
        // API URL
        $apiUrl = "https://junehomes.com/api/v1/residences/feeds/income/create-lead/";

        // API Key (Store this securely in .env)
        $apiKey = env('JUNEHOMES_API_KEY');

        // Prepare payload for JuneHomes API
        $payload = [
            "email" => $formSubmission->email ?? null,
            "phone" => $formSubmission->phone_number ?? null,
            "first_name" => $formSubmission->full_name, // Using full_name as first_name
            "last_name" => null, // Not required, so set to null
            "city" => null, // Not required, set to null
            "renters_message" => null,
            "listing_system_name" => null,
            "move_in" => null,
            "move_out" => null,
            "featured" => null,
            "platform_url" => $formSubmission->submission_url, // Required
            "additional_data" => null, // Optional, so set to null
        ];

        // Make API request
        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($apiUrl, $payload);

        // Log response for debugging
        if ($response->failed()) {
            \Log::error('JuneHomes API Error:', ['response' => $response->json()]);
        } else {
            \Log::info('Lead sent to JuneHomes successfully.', ['response' => $response->json()]);
        }
    }
}
