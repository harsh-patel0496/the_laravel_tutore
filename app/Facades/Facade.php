<?php

namespace App\Facades;

class Facade {

    public static function __callStatic($name,$args){
        return app()->make(static::getFacadeAccessor())->$name();
    }

    // protected static function getFacadeAccessor(){
    //     // code
    // }
}

?>