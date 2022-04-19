<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producttemplate extends Model
{
    protected $fillable = [
        'name','emailtemplate_id','posttype','link','photo','price','postorigin'
    ];

    public function emailtemplate()
    {
        return $this->belongsTo('App\Emailtemplate','emailtemplate_id');
    }
}
