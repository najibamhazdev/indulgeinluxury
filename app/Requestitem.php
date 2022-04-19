<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestitem extends Model
{
    protected $fillable = [
        'clientrequest_id','item_id','category_id'
    ];

    public function items(){
        return $this->belongsTo('App\Item','item_id');
    }

    public function categories(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function clientrequest(){
        return $this->belongsTo('App\Clientrequest','clientrequest_id');
    }

}
