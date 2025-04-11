<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulization extends Model
{
    protected $fillable = [


        'user_id',
        'supervisor',
        'apply_date',
        'type',
        'regulization_date',
        'session',
        'reason',
        'total'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
