<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointStoreRequest;
use App\Models\Site;
use Illuminate\Http\Request;

class EndpointStoreController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke(EndpointStoreRequest $request, Site $site){
        $site->endpoints()->create($request->only(['location', 'frequency']));
        return back();
    }
}
