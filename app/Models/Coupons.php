<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{

    protected $table = 'coupons';
    public $timestamps = true;
    protected $fillable = array('code', 'discount', 'minimum', 'maximum', 'end_at' , 'status');

    public static $rules = [
        'code' => 'required|min:3|max:255',
        'discount' => 'required|numeric',
        'maximum' => 'required|numeric',
        'minimum' => 'required|numeric',
//        'end_at' => 'nullable',
    ];

}
