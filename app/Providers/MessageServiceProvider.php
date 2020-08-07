<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Message;
use App\Http\Controllers\MessageController;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        // $this->app->singleton('MessageController',function($app){
        //     return new MessageController(Message::class);
        // });
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
