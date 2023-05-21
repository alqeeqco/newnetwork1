<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model 
{

    protected $table = 'contact_us';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'email', 'message');

}