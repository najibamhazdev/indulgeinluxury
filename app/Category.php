<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Category extends Model
{
    protected $fillable = [
        'parent','name'
    ];

    

    public function getparent() {
        return $this->belongsTo('App\Category', 'parent');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function clientRequest(){
        return $this.hasMany('App\Clientrequest');
    }
}
