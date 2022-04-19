<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email','phone','country','city','address','dob','job','salary'
    ];

    public function countries()
    {
        return $this->belongsTo('App\Country','country');
    }

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
}
