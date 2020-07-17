<?php
    
    class Sum {

        public function sum(...$arg){

            foreach ($args as $arg){
                $sum += $arg;
            }
        }
    }

?>