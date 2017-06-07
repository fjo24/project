<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table    = "orders";
    protected $fillable = ['user_id', 'date', 'condition', 'created', 'updated'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'created');
    }
    public function up()
    {
        return $this->belongsTo('App\User', 'updated');
    }
    public function products()
    {
    	return $this-> belongsToMany('App\Product');
    }
}
