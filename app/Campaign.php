<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name','subject','template','status','message'
    ];

    public function templates(){
        return $this->belongsTo('App\Emailtemplate', 'template');
    }
}
