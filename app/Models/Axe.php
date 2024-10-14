<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Axe extends Model
{
    use HasFactory;

    protected $table = 'axes'; // Define the table name (optional if follows Laravel conventions)

    // Add axelno and tax_rate to the fillable property
    protected $fillable = ['axelno', 'tax_rate']; // Allow mass assignment for these fields
}
