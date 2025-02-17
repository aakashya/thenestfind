<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'url', 'property_type', 'property_size', 'property_size_unit',
        'bedrooms', 'bathrooms', 'residents', 'description', 'neighborhood', 'address',
        'zip', 'city', 'state', 'country', 'lat', 'lng', 'amenities', '3d_tour', 
        'property_photos', 'check_in_earliest', 'check_in_latest', 'check_in_contact', 
        'check_in_instructions', 'directions', 'house_manual', 'check_in_phone_code', 
        'check_in_phone_number'
    ];

    protected $casts = [
        'amenities' => 'array',
        'property_photos' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
