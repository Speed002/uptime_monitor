<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class PerformEndpointCheck
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
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
        } catch(Exception $e){

        }

        $this->endpoint->check()->create([
            'response_code' => $response->status(),
            'response_body' => !$response->successful() ? $response->body() : null
        ]);

        $this->endpoint->update([
            'next_check' => now()->addSecond($this->endpoint->frequency)
        ]);
    }
}
