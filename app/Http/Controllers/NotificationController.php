<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\InvoicePaid;

class NotificationController extends Controller
{
    //
    public function sendNotification(){
        $user = User::find(1);
        $invoice = 10000;
        $user->notify(new InvoicePaid($invoice));
    }
}
