<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    use sitesTrait;
    
    protected $table = 'tag';
    protected $guarded = ['_token','id'];

    public function setNameAttribute($value){
    	$this->attributes['name'] = $this->permalink($value)."-".strtolower(str_random(5));
    }
}
