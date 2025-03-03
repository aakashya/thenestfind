<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'accommodation_id', 'name', 'room_type', 'room_size', 'room_size_unit',
        'max_occupancy', 'bathroom_type', 'description', 'price', 'amenities', 
        'available_at', 'photos', 'application_url'
    ];

    protected $casts = [
        'price' => 'string', // Store as a string instead of an array
        'amenities' => 'array',
        'photos' => 'array',
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
