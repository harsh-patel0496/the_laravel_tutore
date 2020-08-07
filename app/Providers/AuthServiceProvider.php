<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use App\Policies\MessagePolicy;
use App\Message;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Message' => 'App\Policies\MessagePolicy',
        //Message::class => MessagePolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        //

        // Gate::define('delete-message',function ($user,$message){
        //     return $user->id == $message->user_id;
        // });
    }
}
