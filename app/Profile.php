<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = 'profile';
    protected $guarded = ['_token', 'id'];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
