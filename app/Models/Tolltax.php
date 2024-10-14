<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tolltax extends Model
{
    use HasFactory;

    protected $table = 'tollstax';
    protected $fillable = [
        
        'axeid', 
        
        'from',
        'to',
       
        'tax' // Add tax
    ];

}
