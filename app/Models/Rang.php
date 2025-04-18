<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rang extends Model
{
    use HasFactory;

    public function gamifications()
    {
        return $this->hasMany(Gamification::class, 'id_rang');
    }

    protected $fillable = [
        'libelle',
        'point_min',
        'point_max',
        'description',
    ];

    protected $table = 'rang';
    protected $primaryKey = 'id';
}
