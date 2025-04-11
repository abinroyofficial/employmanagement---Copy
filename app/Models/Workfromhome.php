<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workfromhome extends Model
{
    protected $fillable = [


        'user_id',
        'supervisor',
        'apply_date',
        'leave_type_id',
        'from_date',
        'to_date',
        'section_id',
        'reason',
        'remarks',
        'total'
    ];
    public function LeaveType()
    {
        return $this->belongsTo(LeaveType::class); 
    }

    public function Section()
    {
        return $this->belongsTo(Section::class); 
    }
    public function Status()
    {
        return $this->belongsTo(Status::class); 
    }
}
