<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['city_name', 'slug', 'country_id', 'status', 'image']; // Ensure columns are fillable

    // Define relationship: A city belongs to a country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}

