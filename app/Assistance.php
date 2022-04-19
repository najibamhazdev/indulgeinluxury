<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    protected $fillable = [
        'name','company','email','phone','country','city','details'
    ];

    
    public function countries()
    {
        return $this->belongsTo('App\Country','country');
    }
}
