<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saleitem extends Model
{
    protected $fillable = [
        'sale_id','item_id','employee_id','price','expences','empl_commision'
    ];


    public function employees() {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function items() {
        return $this->belongsTo('App\Item', 'item_id');
    }

    public function sales() {
        return $this->belongsTo('App\Sale', 'sale_id');
    }
}
