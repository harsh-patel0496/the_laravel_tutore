<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $name;
    public function __construct($name)
    {
        //
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    
    public function handle()
    {
        //
        $mail = Mail::to('harsh.patel@openxcell.info')->send(new SendEmail($this->name));
    }
}
