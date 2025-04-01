<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submited_Task extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_Sub_task';
    protected $table = 'submited_tasks';

    protected $fillable = [
        'id_task',
        'id_user',
        'status',
        'files'
    ];
    protected $casts = [
        'files' => 'string' // Assurez-vous que le champ 'files' est traité comme une chaîne
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task');
    }
}