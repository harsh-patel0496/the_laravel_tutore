<?php

namespace App\Providers;

use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $this->app->bindMethod(SendMailJob::class.'@handle', function ($job, $app) {
        //     return $job->handle($app->make(SendMail::class));
        // });
    }
}
