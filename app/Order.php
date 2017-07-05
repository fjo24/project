<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table    = "orders";
    protected $fillable = ['id', 'user_id', 'total', 'paid_out', 'status', 'date', 'title', 'locale', 'event_id', 'notes', 'neto', 'iva', 'discount', 'created', 'updated', 'created_at'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function creat()
    {
        return $this->belongsTo('App\User', 'created');
    }
    public function up()
    {
        return $this->belongsTo('App\User', 'updated');
    }

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_product')->withPivot('quantity');
    }

    public function getdateAttribute($date)
    {
        return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function getupdatedatAttribute($date)
    {
        return $date = \Carbon\Carbon::parse($date)->format('d-m-Y - h:i:s A');
    }

    public function getcreatedatAttribute($date)
    {
        return $date = \Carbon\Carbon::parse($date)->format('d-m-Y - h:i:s A');
    }

    public function setdateAttribute($date)
    {
        $this->attributes['date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
    
    //for calendar
    public function getId() {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getStart()
    {
        return $this->date;
    }
    public function getEnd()
    {
        return $this->date;
    }
}