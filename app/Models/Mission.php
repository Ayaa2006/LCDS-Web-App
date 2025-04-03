<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AgendaCrm;

class Mission extends Model
{
    protected $fillable = [
        'date_debut',
        'date_fin', 
        'remarques',
        'id_client'
    ];

    public function client()
    {
        return $this->belongsTo(AgendaCrm::class, 'id_client');
    }
}
