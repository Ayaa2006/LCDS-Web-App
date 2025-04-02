<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaCrm extends Model
{
    use HasFactory;

    protected $table = 'agenda_crm';
    
    protected $fillable = [
        'nom_client',
        'telephone', 
        'email',
        'adresse_postale',
        'etat_advertissement'
    ];
    
    protected $casts = [
        'etat_advertissement' => 'string'
    ];
}
