<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    // Make sure 'code' is also fillable, so it can be mass-assigned
    protected $fillable = ['email', 'code']; // Add 'code' to the fillable property
}
