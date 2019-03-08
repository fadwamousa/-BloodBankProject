<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    public $table = "contactus";
    protected $fillable = array('name','email','title','message','phone');
    //set your field in fillable that is mean all fields in this is array will mass into DB
    //$guarded = this is mean all fields in guarded will not mass int DB.
    
}
