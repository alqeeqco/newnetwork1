<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('id_country', 'name_en', 'name_ar' , 'status');

    public static $rules = [
        'name_ar' => 'required|min:3|max:255',
        'name_en' => 'required|min:3|max:255',
        'id_country' => 'required|exists:countries,id',
    ];

    public function countries(){

        return $this->belongsTo('\App\Models\Countries' , 'id_country'  , 'id');
    }

}
