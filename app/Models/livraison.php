<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livraison extends Model
{
    use HasFactory;

    protected $fillable = ['destinataire', 'user_id', 'adresse', 'status', 'tracking_number'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isDelivered()
    {
        return $this->status === 'delivered';
    }
}
