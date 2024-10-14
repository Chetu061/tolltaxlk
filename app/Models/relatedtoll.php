<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relatedtoll extends Model
{
    use HasFactory;
    protected $fillable = ['newtoll_id', 'tollname', 'price'];

    public function newtoll()
    {
        return $this->belongsTo(newtoll::class);
    }
}
