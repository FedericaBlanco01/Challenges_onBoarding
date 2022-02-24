<?php

namespace App\Models;

use Database\Factories\FlightFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function availableCities()
    {
        return $this->belongsToMany(City::class);
    }
}
