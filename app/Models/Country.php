<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['country_name', 'country_code', 'image']; // Ensure columns are fillable

    // Define relationship: A country has many cities
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
