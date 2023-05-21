<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paymentoptions extends Model
{

    protected $table = 'payment_options';
    public $timestamps = true;
    protected $fillable = ['image'];
}
