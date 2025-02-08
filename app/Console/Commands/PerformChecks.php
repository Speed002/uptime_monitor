<?php

namespace App\Console\Commands;

use App\Models\Endpoint;
use Illuminate\Console\Command;
use App\Jobs\PerformEndpointCheck;

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
        // We only want to run this command on checks that are less times than the now, not above now, because that will be the future, but the ones in the past, so that the
        // so that upon checking those endpoints, we can have another target in the future, since time moves forward and never backwards.
        // Hence, we retrieve the endpoints that are less than now time and run the command checks on them and the JOB will update their next_check... this will be scheduled automatically
        $endpoints = Endpoint::where('next_check', '<=', now())->each(function($endpoint){
            // This command: upon running, dispatches or spreads the $endpoint variable to the JOB:PerformEndpointCheck.php which will
            // then be responsible for updating the next_check field of the currently iterating $endpoint to next frequency
                PerformEndpointCheck::dispatch($endpoint);
            // });
        });
        return command::SUCCESS;
    }
}
