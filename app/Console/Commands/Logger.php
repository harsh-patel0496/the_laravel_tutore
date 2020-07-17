<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class Logger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:logger {log_sentance?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump the data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        

        $response = Http::get('http://test.com');
        $name = $this->ask('What is your name?');
        print_r($response);
    }
}
