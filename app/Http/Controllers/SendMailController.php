<?php

namespace App\Http\Controllers;


use App\Mail\SendEmail;
use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    //

    public function sendMail(){
        SendMailJob::dispatch('Parth');
        
        return 'Email send properly';
    }
}
