<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //

    protected $fillable = ['role_id','module','_add','_edit','_delete','_others'];

    public function role(){
        return $this->belongsTo('App\Role','role_id');
    }
}
