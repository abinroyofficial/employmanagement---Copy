<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLeave extends Model
{
    protected $fillable = [


        'user_id',
        'year',
        'casual_leave',
        'sick_leave',
        'earned_leave'
    ];
  
}
