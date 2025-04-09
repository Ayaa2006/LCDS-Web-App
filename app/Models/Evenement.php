<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = [
        'nomEvent',
        'description',
        'mediaAssocie',
        'statut',
        'datePublication',
        'nbrDeJours'
    ];

    protected $casts = [
        'datePublication' => 'datetime'
    ];
}
