<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'default',
        'domain',
        'scheme'
    ];

    // THIS OBSERVER HAS BEEN REPLACED BY A REAL OBSERVER -> SITEOBSERVER
    // // this is the static function that holds all the lifecycle events like: creating, updating, deleting
    // public static function booted(){
    //     static::updating(function(Site $site){
    //         if(in_array('default', array_keys($site->getDirty()))){
    //             // go into the current site, via the user relationship with the current user,
    //             // get all this current users sites, where id is not the current site->id,
    //             // update them by setting the default to false
    //             $site->user->sites()->whereNot('id', $site->id)->update(['default' => false]);
    //         }
    //     });
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function endpoints(){
        return $this->hasMany(Endpoint::class);
    }


}
