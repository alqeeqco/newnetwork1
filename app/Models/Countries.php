<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{

    protected $table = 'countries';
    public $timestamps = true;
    protected $fillable = array('name_en', 'name_ar' , 'status');

    public static $rules = [
        'name_ar' => 'required|min:3|max:255',
        'name_en' => 'required|min:3|max:255',
    ];

    public function cities()
    {
        return $this->belongsTo('\App\Models\Cities','city_id','id');
    }
}
