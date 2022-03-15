<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function departure_city()
    {
        return $this->belongsTo(City::class, 'departure_city_id');
    }

    public function arrival_city()
    {
        return $this->belongsTo(City::class, 'arrival_city_id');
    }
}
