<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function departur_city()
    {
        return $this->belongsTo(City::class, 'departure_city');
    }

    public function arrival_city()
    {
        return $this->belongsTo(City::class, 'arrival_city');
    }
}
