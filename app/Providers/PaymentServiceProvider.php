<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Response;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditcardPaymentGateway;
use App\Fishing\Fish;

class PaymentServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    // public $singletons = [
    //     PaymentGatewayContract::class => BankPaymentGateway::class
    // ];
    public function register()
    {
        //dd(app());
        //Register service container to our app
        $this->app->singleton('PaymentGatewayContract',function($app,$params){
            if(request()->has('credit')){
                
                return new CreditcardPaymentGateway($params);
            }
            return new BankPaymentGateway($params);
        });

        $this->app->bind('fish',function($app,$params){
            return new Fish();
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
        Response::macro('caps', function ($value) {
            return Response::make(strtoupper($value));
        });
    }
}
