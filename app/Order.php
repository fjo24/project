<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table    = "orders";
    protected $fillable = ['id', 'date', 'end_date', 'title', 'type', 'user_id', 'provider_id', 'status', 'locale', 'notes', 'total', 'created', 'updated'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this-> belongsToMany('App\Product', 'order_product')->withPivot('quantity');
    }

    public function getdateAttribute($date)
    {
        return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function setdateAttribute($date)
    {
        $this->attributes['date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
    }

    public function getendDateAttribute($date)
    {
        return $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function setendDateAttribute($date)
    {
        $this->attributes['end_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
    }

    public function creat()
    {
        return $this->belongsTo('App\User', 'created');
    }
    public function up()
    {
        return $this->belongsTo('App\User', 'updated');
    }

    

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
