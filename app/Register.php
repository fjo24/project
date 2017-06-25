<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
	protected $table    = "registers";
    protected $fillable = ['id', 'date', 'type', 'info', 'provider_id', 'created', 'updated'];

    public function provider()
    {
    	return $this->belongsTo('App\Provider', 'provider_id');
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
        return $this-> belongsToMany('App\Product', 'product_register')->withPivot('quantity');
    }

}
