<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table    = "events";
    protected $fillable = ['id', 'name'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
