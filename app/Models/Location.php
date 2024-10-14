<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    protected $table = 'locations';
    protected $fillable = ['city', 'latitude', 'longitude'];

    /**
     * Calculate the distance from this location to another location.
     *
     * @param Location $location
     * @return float Distance in kilometers
     */
    public function distanceTo(Location $location)
    {
        // Haversine formula to calculate the distance between two points on the earth
        $earthRadius = 6371; // Radius of the Earth in km

        $latFrom = deg2rad($this->latitude);
        $lonFrom = deg2rad($this->longitude);
        $latTo = deg2rad($location->latitude);
        $lonTo = deg2rad($location->longitude);

        $latDiff = $latTo - $latFrom;
        $lonDiff = $lonTo - $lonFrom;

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDiff / 2) * sin($lonDiff / 2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in kilometers
    }
}

