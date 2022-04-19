<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Item extends Model
{
    protected $fillable = [
        'category','brand','name','unit_price','color','size','details'
    ];

    public function categories() {
        return $this->belongsTo('App\Category', 'category');
    }

    public function brands() {
        return $this->belongsTo('App\Brand', 'brand');
    }
    
    public function sales()
    {
        return $this->hasMany('App\Sale');
    }

    public function saleitems()
    {
        return $this->hasMany('App\Saleitem');
    }


    public function clientRequests(){
        return $this->hasMany('App\Clientrequest');
    }
    
}
