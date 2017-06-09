<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
	protected $table    = "registers";
    protected $fillable = ['id', 'provider_id', 'product_id', 'type', 'quantity', 'info', 'cost'];

    public function provider()
    {
    	return $this->belongsTo('App\Provider', 'provider_id');
    }
    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
