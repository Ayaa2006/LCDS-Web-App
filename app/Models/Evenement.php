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

    // Dans le modèle Evenement
public function markAsDeleted()
{
    if ($this->statut !== 'supprimer') {
        $this->update(['statut' => 'supprimer']);
        event(new EventDeleted($this)); // Déclencher un event si vous utilisez des listeners
        return true;
    }
    return false;
}
}
