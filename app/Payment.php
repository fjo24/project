<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table    = "payments";
    protected $fillable = ['id', 'date', 'type', 'status', 'mount', 'ref', 'order_id', 'user_id'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getdateAttribute($date)
    {
        return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function setdateAttribute($date)
    {
        $this->attributes['date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}