<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model 
{

    protected $table = 'colors';
    public $timestamps = true;
    protected $fillable = array('product_id', 'color', 'quantity');

}