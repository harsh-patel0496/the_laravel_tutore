<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Billing\BankPaymentGateway;
use App\Billing\Amount;
use App\Billing\Sum;
use App\Billing\PaymentGatewayContract;
use App\Billing\CreditcardPaymentGateway;

use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // $this->app->singleton('PaymentGatewayContract' ,function($app,$params){
        //     if(request()->query('credit') == true || request()->has('credit')){
        //         return new CreditcardPaymentGateway($params);
        //     }
        //     return new BankPaymentGateway($params);

        // });

        // $this->app->when(PaymentGateway::class)->needs(Amount::class)->give(function(){
        //     return Sum::class;
        // });
        // $this->app->instance('PaymentGateway',function($app,$params){
        //     return new PaymentGetway($params);
        // });

        //dd(app());  
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        // Queue::before(function (JobProcessing $event) {
        //     // $event->connectionName
        //     // $event->job
        //     // $event->job->payload()
        //     echo "Before Send an Email ------- \n";
        // });

        // Queue::after(function (JobProcessed $event) {
        //     // $event->connectionName
        //     // $event->job
        //     // $event->job->payload()
        //     echo "After Send an Email ------- \n";
        // });
    }
}
