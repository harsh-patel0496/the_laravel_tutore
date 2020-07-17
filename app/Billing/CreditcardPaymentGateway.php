<?php

    namespace App\Billing;
    
    use Illuminate\Support\Str;

    class CreditcardPaymentGateway implements PaymentGatewayContract {
        
        public $fees;
        
        public function __construct(){
            $this->fees = 100;
            $this->discount = 0;
        }

        public function setDiscount($discount){
            $this->discount = $discount;
        }

        public function charge($amount){

            $this->fees = $amount * 0.03;
            return array(
                'amount' => ($amount - $this->discount) + $this->fees,
                'confirmation_number' => Str::random(),
                'discount' => $this->discount,
                'fees' => $this->fees
            );
        }
    }
?>