<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{

    protected $table = 'ads';
    public $timestamps = true;
    protected $fillable = array('title_en', 'title_ar', 'url', 'image', 'status' , 'location');

    public static $rules = [
        'title_ar' => 'required|min:3|max:255',
        'title_en' => 'required|min:3|max:255',
        'url' => 'required|min:3',
        'image' => 'required|image',
    ];
    public static $rules2 = [
        'title_ar' => 'required|min:3|max:255',
        'title_en' => 'required|min:3|max:255',
        'url' => 'required|min:3',
        'image' => 'nullable|image',
    ];

}
