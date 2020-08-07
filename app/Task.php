<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany('App\User','task_user','task_id','user_id');
    }
}
