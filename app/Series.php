<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
    protected $table = 'series';
    protected $guarded = ['_token','id'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function lessons(){
    	return $this->hasMany('App\Lessons','series_id');
    }
}
