<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;
use App\Http\Requests\EndpointUpdateRequest;

class EndpointUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(EndpointUpdateRequest $request, Endpoint $endpoint)
    {
        $endpoint->update($request->only(['location', 'frequency']));
        return back();
    }
}
