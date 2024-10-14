<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toll extends Model
{
    use HasFactory;

    protected $table = 'tolls';

    protected $fillable = [
        'carno',
        'aadhar',
        'axeid', 
        'intime',
        'outtime',
        'from',
        'to',
        'total_tax',
        'distance_km', // Add distance_km
        'tax',
        'axeid1'
         // Add tax
    ];

    public function axel()
    {
        return $this->belongsTo(Axe::class, 'axeid', 'id');
    }

    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to', 'id'); // 'to' is the foreign key in the current table
    }

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from', 'id'); // 'from' is the foreign key in the current table
    }
}
