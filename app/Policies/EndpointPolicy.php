<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;

class EndpointPolicy
{
    public function update(User $user, Endpoint $endpoint){
        // ensure that the user_id === to the user_id of the site that owns the endpoint
        return $user->id === $endpoint->site->user_id;
    }
    public function destroy(User $user, Endpoint $endpoint){
        // ensure that the user_id === to the user_id of the site that owns the endpoint
        return $user->id === $endpoint->site->user_id;
    }
    public function show(User $user, Endpoint $endpoint){
        // ensure that the user_id === to the user_id of the site that owns the endpoint
        return $user->id === $endpoint->site->user_id;
    }

}
