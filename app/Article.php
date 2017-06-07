<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table    = "articles";
    protected $fillable = ['title', 'content', 'created_by', 'updated_by'];
    
	public function user()
    {
    	return $this->belongsTo('App\User', 'created_by');
    }
    public function updatedby()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
