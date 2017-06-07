<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $table    = "providers";
    protected $fillable = ['id', 'name', 'rif'];

    public function registers()
    {
        return $this->hasMany('App\Register');
    }
}
