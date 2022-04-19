<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = [
        'name','stat','date','time','details','comments'
    ];
}
