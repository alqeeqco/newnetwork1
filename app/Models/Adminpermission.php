<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminpermission extends Model 
{

    protected $table = 'admin_permission';
    public $timestamps = true;
    protected $fillable = array('admin_id');

}