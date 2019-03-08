<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone','password','email','name','date_birth','last_date_request','type_id','city_id');

    public function governates()
    {
        return $this->hasMany('App\Governorate');
    }

    public function types()
    {
        return $this->hasMany('App\Type');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    protected $hidden = [
        'password', 'api_token',
    ];

}