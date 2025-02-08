<?php

namespace App\Jobs;

use Log;
use Exception;
use App\Models\Endpoint;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PerformEndpointCheck
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    // This constructor recieves the $endpoint from the command:PerformChecks that dispatches the $endpoint in its handle() function
    // that is the purpose of dispatch(), it will spread the current variable $endpoint to the class you want it to go to
    public function __construct(public Endpoint $endpoint)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $response = Http::get($this->endpoint->url());
            // dd($response->status()); testing the check
            // \Log::info($response->status());
        } catch(Exception $e){

        }
        //this handle() method is using the dispatched $endpoint from the constructor that recieved it, so that it may use it
        // here we are updaing the check of the current $endpoint to the details of what was returned
        $this->endpoint->checks()->create([
            'response_code' => $response->status(),
            // if the response was not successful, we want to go ahead and store the response_body so we can see what happened, otherwise if response was successful, there's no need to see anything
            'response_body' => !$response->successful() ? $response->body() : null
        ]);

        // Here, we are updating the current endpoints next_check column to the similar frequency above it
        $this->endpoint->update([
            'next_check' => now()->addSecond($this->endpoint->frequency)
        ]);
    }
}
