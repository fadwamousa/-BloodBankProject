<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model 
{

    protected $table = 'types';
    public $timestamps = true;

    public function donors()
    {
        return $this->hasMany('App\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}