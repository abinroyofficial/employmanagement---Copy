<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    
    use HasFactory, Notifiable,HasRoles;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_reset'
    ];
    public function regulizations(){
        return $this->hasMany(Regulization::class);
    }
    public function userData()
    {
        return $this->hasOne(Manager::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    

   
    protected $hidden = [
        'password',
        'remember_token',
        'password_reset',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
