<?php

namespace App\Observers;

use App\Models\Endpoint;
use Illuminate\Support\Arr;

class EndpointObserver
{
    public function creating(Endpoint $endpoint){
        $parsed = parse_url($endpoint->site->url().'/'.$endpoint->location);
        // triming any / and ? as we join the entire domain
        $endpoint->location = '/'.trim(trim(Arr::get($parsed, 'path'), '/').'?'. Arr::get($parsed, 'query'), '?');
        // dd($endpoint->location);

        $endpoint->next_check = now()->addSeconds($endpoint->frequency);
    }
}
