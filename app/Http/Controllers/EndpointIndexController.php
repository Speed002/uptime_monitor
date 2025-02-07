<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointIndexController extends Controller
{
    public function __construct()
    {

    }

    public function __invoke(Request $request, Endpoint $endpoint)
    {
        // dd($endpoint);
        return inertia()->render('Endpoint');
    }
}
