<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, Site $site){
        // set the site accessed to be the default upon its access
        $site->update(['default' => true]);

        if(!$site->exists){
            $site = $request->user()->sites()->whereDefault(true)->first() ?? $request->user()->sites()->first();
        }
    

        return inertia()->render('Dashboard', [
            'site' => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get())
        ]);
    }
}
