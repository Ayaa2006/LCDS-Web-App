<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gamification extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'point', 'code', 'friendCode', 'tasks_done', 'user_id'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function submissions()
    {
        return $this->hasMany(Submited_Task::class, 'id_task');
    }
    
    public function rang()
    {
        return $this->belongsTo(Rang::class, 'id_rang');
    }
    
}
