<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    protected $fillable = [
        'client_id','total','date','details','shipping_to','shipping_cost'
    ];

    public function clients() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function saleitems() {
        return $this->hasMany('App\Saleitem');
    }


    

}

