<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email','phone','country','city','address','dob','gender','pobox'
    ];

    public function countries()
    {
        return $this->belongsTo('App\Country','country');
    }

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }

    public function clientRequest(){
        return $this.hasMany('App\Clientrequest');
    }
}

