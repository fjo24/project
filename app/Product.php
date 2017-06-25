<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table    = "products";
    protected $fillable = ['id', 'name', 'type', 'info', 'quantity', 'available', 'cost'];
    
    public function registers()
    {
        return $this->belongsToMany('App\Register', 'product_register')->withPivot('quantity');
    }

    public function orders()
    {
    	return $this->belongsToMany('App\Order', 'order_product')->withPivot('quantity');
    }
}