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
        $appUrlHost = parse_url(config('app.url'), PHP_URL_HOST);

        // Validate input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'nullable|regex:/^\+?[0-9-]{1,10}$/',
            'phone_number' => 'required|regex:/^[0-9()+\\-\\s]{6,20}$/',
            'accommodation_id' => 'required|integer|exists:accommodations,id',
            'room_id' => 'nullable|string|exists:rooms,id', // Allow empty for general enquiries
            'submission_url' => [
                'required',
                'url',
                'max:2048',
                function ($attribute, $value, $fail) use ($appUrlHost) {
                    if (!$appUrlHost) {
                        return;
                    }

                    $submittedHost = parse_url($value, PHP_URL_HOST);
                    if (!$submittedHost || strcasecmp($submittedHost, $appUrlHost) !== 0) {
                        $fail('Invalid submission URL.');
                    }
                },
            ],
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
            $room = Room::where('id', $validated['room_id'])
                ->where('accommodation_id', $accommodation->id)
                ->first();

            if (!$room) {
                return redirect()->back()
                    ->withErrors(['room_id' => 'Invalid room selection.'])
                    ->withInput();
            }

            $roomName = $room->name;
            $roomDuration = $room->available_at ? (string) $room->available_at : null;
            $roomPrice = is_scalar($room->price) ? (string) $room->price : null;
        }

        // Store form submission
        $formSubmission = FormSubmission::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'country_code' => $validated['country_code'],
            'phone_number' => $validated['phone_number'],
            'accommodation_id' => (string) $accommodation->id,
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
        if (empty($apiKey)) {
            \Log::warning('JuneHomes API key is missing. Lead submission skipped.');
            return;
        }

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
        $response = Http::timeout(10)->withHeaders([
            'X-API-KEY' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($apiUrl, $payload);

        // Log response for debugging
        if ($response->failed()) {
            \Log::error('JuneHomes API Error.', ['status' => $response->status()]);
        } else {
            \Log::info('Lead sent to JuneHomes successfully.', ['status' => $response->status()]);
        }
    }
}
