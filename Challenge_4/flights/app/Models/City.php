<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    static function existOrNull($newCity)
    {
        $cities = City::all()->toArray();
        if (empty($newCity)) {
            return true;
        }

        foreach ($cities as $city) {
            foreach ($city as $attribute => $data) {
                if ($attribute == "name" && $data == $newCity) {
                    return true;
                }
            }
        }
        return false;
    }

    public function flightsAsDeparture()
    {
        return $this->hasMany(Flight::class, 'departure_city_id');
    }

    public function flightsAsArrival()
    {
        return $this->hasMany(Flight::class, 'arrival_city_id');
    }

    public function availableAirline()
    {
        return $this->belongsToMany(Airline::class);
    }
}
