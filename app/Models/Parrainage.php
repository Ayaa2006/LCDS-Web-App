<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrainage extends Model
{
    use HasFactory;
    protected $fillable = [ 'reff_id', 'user_id'];
    public function parrain()
    {
        return $this->belongsTo(\App\Models\User::class, 'reff_id');
    }
    
    public function filleul()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    

}
