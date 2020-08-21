<?php

namespace App\ResponseJson;

class ResponseJson {


    //Prepare preety response
    public function result($status,$message = '',$module = '',$data = []){
        $result = array();
        $result['status'] = $status;
        if(isset($message) && $message != ''){
            $result['message'] = $message;
        }
        if(isset($module) && $module != '' && !empty($data)){
            $result[$module] = $data;
        }

        return $result;
    }
}

?>