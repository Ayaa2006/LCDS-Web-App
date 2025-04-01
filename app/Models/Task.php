<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'point','CanLink'];
    public function submissions()
{
    return $this->hasMany(Submited_Task::class, 'id_task');
}
}

