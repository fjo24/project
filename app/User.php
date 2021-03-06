<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id', 'fullname', 'name', 'lastname', 'type', 'level', 'email', 'identification', 'telephone', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
