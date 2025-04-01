<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'date' ,'code' ,'user_id'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
