<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'status_name'
    ];
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function workfromhomes()
    {
        return $this->hasMany(Workfromhome::class);
    }
}
