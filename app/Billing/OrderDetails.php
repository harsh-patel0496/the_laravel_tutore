<?php

    namespace App\Billing;

    

    class OrderDetails {

        private $paymentGateway;

        public function __construct(){
            $this->paymentGateway = app()->make('PaymentGatewayContract');
        }
        public function all($discount){
            $this->paymentGateway->setDiscount($discount);

            return [
                "name" => "Harsh",
                "address" => "Ahm"
            ];
        }
    }
    
?>