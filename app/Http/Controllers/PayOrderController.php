<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Billing\OrderDetails;
use App\Facades\FishFacade;

class PayOrderController extends Controller
{
    //
    public function store(OrderDetails $orderdetails){

        $order = $orderdetails->all(10);
        $paymentGateway = app()->make('PaymentGatewayContract');
        dump($paymentGateway->charge(10));
        $order2 = $orderdetails->all(20);
        dump($paymentGateway->charge(30));
        dump(FishFacade::swim());
        return response()->caps('Harsh');
    }
}
