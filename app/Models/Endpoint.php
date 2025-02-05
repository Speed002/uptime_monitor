<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'frequency',
        'next_check'
    ];

    public $dates = [
        'next_check'
    ];

    public function site(){
        return $this->belongsTo(Site::class)->latest();
    }
}
