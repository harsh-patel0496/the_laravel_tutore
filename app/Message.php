<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $connection = 'sqlite';
    protected $guarded = [];

    public function users(){
    	return $this->belongsTo('App\User','user_id');
    }
}
