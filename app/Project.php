<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany('App\User','project_user','project_id','user_id');
    }

    public function tasks(){
        return $this->morphToMany('App\Task','assignable');
    }
}
