<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    use HasFactory;
    protected $fillable = ['fname', 'lname', 'email', 'adress', 
    'montant', 'date', 'mode_paiement', 'status','user_id'];
}
