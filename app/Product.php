<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table    = "products";
    protected $fillable = ['id', 'name', 'info', 'cost_c', 'min'];
    
    public function registers()
    {
        return $this->hasMany('App\Register');
    }
    public function orders()
    {
    	return $this-> belongsToMany('App\Order');
    }
}
