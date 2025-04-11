<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'task_name',
        'task_description',
        'task_deadline',
        'estimated_time',
        'task_dependencies',
        'status'  
    ];
}
