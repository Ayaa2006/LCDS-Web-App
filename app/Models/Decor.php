<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_box',
        'date_acquisition',
        'fournisseur',
        'date_exposition',
        'description'
    ];

    protected $casts = [
        'date_acquisition' => 'date',
        'date_exposition' => 'date',
    ];
}