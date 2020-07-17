<?php

namespace App\Billing;

use Illuminate\Support\Str;

class BankPaymentGateway implements PaymentGatewayContract {

    public $discount;

    public function __construct(){
        $this->discount = 0;
    }

    public function charge($amount){
        return ['amount' => $amount - $this->discount,'confirmation_number' => Str::random(),'discount' => $this->discount];
    }

    public function setDiscount($discount){
        $this->discount = $discount;
    }
}