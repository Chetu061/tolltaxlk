<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newtoll extends Model
{
    use HasFactory;
    protected $fillable = ['from', 'to', 'axel_no', 'total'];

    public function relatedtoll()
    {
        return $this->hasMany(relatedtoll::class);
    }
    
    public function axel()
{
    return $this->belongsTo(Axe::class,'axel_no','id');
}
public function toLocation()
{
    return $this->belongsTo(Location::class, 'to','id'); // 'to' is the foreign key in the current table
}

public function fromLocation()
{
    return $this->belongsTo(Location::class, 'from','id'); // 'from' is the foreign key in the current table
}
}
