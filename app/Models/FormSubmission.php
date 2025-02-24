<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'country_code',
        'phone_number',
        'accommodation_id', // Stored as a string
        'accommodation_name',
        'room_name',
        'room_duration',
        'room_price', // Stored as a string
        'message',
        'submission_url',
        'provider',
    ];
}
