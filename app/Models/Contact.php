<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'object',
        'message'
    ];

    public function reponses()
{
    return $this->hasMany(Reponse::class);
}

public function hasReponse()
{
    return $this->reponses()->exists();
}
}