<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name_en', 'name_ar', 'status', 'image');

    public static $rules = [
        'name_ar' => 'required|min:3|max:255',
        'name_en' => 'required|min:3|max:255',
        'image' => 'required|image',
    ];
    public static $rules2 = [
        'name_ar' => 'required|min:3|max:255',
        'name_en' => 'required|min:3|max:255',
        'image' => 'nullable|image',
    ];

}
