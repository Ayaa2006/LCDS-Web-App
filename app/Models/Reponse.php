<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Reponse extends Model
{
    protected $fillable = ['contact_id', 'object', 'message'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}