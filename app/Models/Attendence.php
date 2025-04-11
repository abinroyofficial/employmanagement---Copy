<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $fillable = [
        'employ_id',
        'user_id',
        'date',
        'sign_in',
        'sign_out',
        'shift',
        'total_time',
        'attendance_status'
    ];

    public function LeaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
