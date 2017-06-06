<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table    = "orders";
    protected $fillable = ['user_id', 'date', 'condition', 'created_by', 'last_updated_by'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function products()
    {
    	return $this-> belongsToMany('App\Product');
    }
}
