<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    //
    protected $table = 'lessons';
    protected $guarded = ['_token', 'id','tags'];

    public function series(){
        return $this->belongsTo('App\Series','series_id');
    }

    public function tag(){
    	return $this->belongsToMany(Tag::class,'lessons_tag','lesson_id','tag_id');
    }

    public function user(){
    	 return $this->belongsTo('App\User','users_id');
    }

    public function roled(){
        return $this->belongsToMany('App\User','users_lessons','lesson_id','user_id');
    }
}
