<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 
        'fournisseur', 
        'date_achat', 
        'prix', 
        'maintenance_dates'
    ];

    protected $casts = [
        'date_achat' => 'date',
        'maintenance_dates' => 'string', // Pour stocker les dates comme tableau
    ];
   
}