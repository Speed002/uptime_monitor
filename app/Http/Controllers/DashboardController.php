<?php

namespace App\Http\Controllers;

use App\Enums\EndpointFrequency;
use App\Http\Resources\EndpointFrequencyResource;
use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, Site $site){
        // set the site accessed to be the default upon its access
        // this attribute: default and its value true will be checked by $site->getDirty()
        $site->update(['default' => true]);
        // getDirty gets the array of the attributes of the model that have been changed but not yet pushed to the database

        if(!$site->exists){
            // if the site does not exist, we are getting the current user and through the rlship with sites(), we are getting users'
            // sites where default has a value true, and we are picking the first site to display as our default site:
            // if no site is true, then we are picking the first site in the list of sites of the user and we are assigning it as our current site[default site]
            $site = $request->user()->sites()->whereDefault(true)->first() ?? $request->user()->sites()->first();
        }


        return inertia()->render('Dashboard', [
            'site' => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get()),
            'endpoints' => EndpointResource::collection($site->endpoints)
        ]);
    }
}
