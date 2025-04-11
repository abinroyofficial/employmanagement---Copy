<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [


        'session_name'

    ];
    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function workfromhomes(){
        return $this->hasMany(Workfromhome::class);
    }
}
