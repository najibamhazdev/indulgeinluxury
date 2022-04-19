<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emailtemplate extends Model
{
    protected $fillable = [
        'name','headertext','footertext','photo','titlephoto','textafterphoto','footerphoto','textafterfooterphoto','color'
    ];

    public function templates()
    {
        return $this->hasMany('App\Campaign');
    }

}
