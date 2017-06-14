<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table    = "orders";
    protected $fillable = ['id', 'user_id', 'date', 'status', 'locale', 'title', 'total', 'created', 'updated'];

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

    public function creat()
    {
        return $this->belongsTo('App\User', 'created');
    }
    public function up()
    {
        return $this->belongsTo('App\User', 'updated');
    }

    public function products()
    {
    	return $this-> belongsToMany('App\Product', 'order_product')->withPivot('quantity');
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
