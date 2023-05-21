<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shippingoptions extends Model
{

    protected $table = 'shipping_options';
    public $timestamps = true;
    protected $fillable = array('id_countries', 'name_en', 'name_ar', 'image', 'des_en', 'des_ar', 'price', 'work' , 'first_cleo' , 'Price_kilo_after_first' , 'status');


    public static $rules = [
        'id_countries' => 'required|exists:countries,id',
        'name_en' => 'required|min:3|max:255',
        'name_ar' => 'required|min:3|max:255',
        'image' => 'required|image',
        'des_en' => 'required',
        'des_ar' => 'required',
        'price' => 'required',
    ];

    public static $rules2 = [
        'id_countries' => 'required|exists:countries,id',
        'name_en' => 'required|min:3|max:255',
        'name_ar' => 'required|min:3|max:255',
        'image' => 'nullable|image',
        'des_en' => 'required',
        'des_ar' => 'required',
        'price' => 'required',
    ];

    public function Countries(){
        return $this->belongsTo('\App\Models\Countries' , 'id_countries'  , 'id');
    }

}
