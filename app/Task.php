<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = ['project','description'];

    public function users(){
        return $this->morphedByMany('App\User','assignable');
    }

    public function projects(){
        return $this->morphedByMany('App\Project','assignable');
    }

    
}
