<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $table = 'category';
    protected $guarded = ['_token', 'id'];

    public function issues(){
        return $this->hasMany('App\Issues','category_id');
    }
}
