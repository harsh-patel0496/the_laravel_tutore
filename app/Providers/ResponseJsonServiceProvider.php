<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ResponseJson\ResponseJson;

class ResponseJsonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Bind ResponseJson class object with responseJson to create Facade
        $this->app->bind('responseJson',function($app,$params){
            return new ResponseJson();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
