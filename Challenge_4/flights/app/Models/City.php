<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function flight()
    {
        return $this->hasMany(Flight::class);
    }

    public function availableFlights()
    {
        return $this->belongsToMany(Airline::class);
    }
}
