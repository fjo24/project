<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
	protected $table    = "registers";
    protected $fillable = ['provider_id', 'product_id', 'type', 'date', 'content', 'quantity', 'cost'];

    public function provider()
    {
    	return $this->belongsTo('App\Provider');
    }
    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
