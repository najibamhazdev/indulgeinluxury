<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country_code','country_name'
    ];

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function assistances()
    {
        return $this->hasMany('App\Assistance');
    }

}
