<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientrequest extends Model
{
    protected $fillable = [
        'client_id','date','details'
    ];

    public function clients(){
        return $this->belongsTo('App\Client', 'client_id');
    }



    public function requestitems(){
        return $this->hasMany('App\Requestitem','clientrequest_id');
    }
}
