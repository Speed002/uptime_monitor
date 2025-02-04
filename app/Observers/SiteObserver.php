<?php

namespace App\Observers;

use App\Models\Site;
use Illuminate\Support\Arr;

class SiteObserver
{
    public function creating(Site $site){
        $parsed = parse_url($site->domain);
        // dd($parsed); returns to use the scheme and the domain
        $site->scheme = Arr::get($parsed, 'scheme');
        $site->domain = Arr::get($parsed, 'host');
    }

    public function updating(Site $site){
        if(in_array('default', array_keys($site->getDirty()))){
            // go into the current site, via the user relationship with the current user,
            // get all this current users sites, where id is not the current site->id,
            // update them by setting the default to false
            $site->user->sites()->whereNot('id', $site->id)->update(['default' => false]);
        }
    }
}
