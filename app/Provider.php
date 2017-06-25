<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $table    = "providers";
    protected $fillable = ['id', 'name', 'telephone', 'rif', 'locale', 'email'];

    public function registers()
    {
        return $this->hasMany('App\Register');
    }
}
