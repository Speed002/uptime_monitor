<?php

namespace App\Console\Commands;

use App\Models\Endpoint;
use Illuminate\Console\Command;

class PerformChecks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checks:perform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform endpoint checks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //checking and counting the checks back from now or in the past
        // $endpoints = Endpoint::where('next_check', '<=', now())->count();
        // dd($endpoints); //this dd() will read in the terminal
        $endpoints = Endpoint::where('next_check', '<=', now())->each(function(){
            // job: this is where we are going to queue
        });
        return command::SUCCESS;
    }
}
