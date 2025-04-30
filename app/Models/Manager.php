<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Manager extends Model
{
    use HasFactory, Notifiable, HasRoles;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [

        'employ_id',
        'user_id',
        'phone',
        'department_id',
        'gender_id',
        'supervisor',
        'work_time_from',
        'work_time_to',
        'salary',
        'leave',
        'photo'
    ];
    public function department()
    {
        return $this->belongsTo(department::class,);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
}
