<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'address';
    public $timestamps = true;
    protected $fillable = array('user_id', 'city_id', 'country_id','street', 'district', 'note' , 'czip' , 'cpobox' , 'cmobile');

    public static $rules = [
        'city_id' => 'required|exists:cities,id',
        'street' => 'required|min:3|max:255',
        'district' => 'required|min:3|max:255',

        'czip' => 'required',
        'cpobox' => 'required',
        'cmobile' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cities()
    {
        return $this->belongsTo('\App\Models\Cities','city_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class,'country_id','id');
    }

}
