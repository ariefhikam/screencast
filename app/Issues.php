<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    //
    protected $table = 'issues';
    protected $guarded = ['_token', 'id'];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
