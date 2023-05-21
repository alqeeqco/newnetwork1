<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{

    protected $table = 'why_choose_us';
    public $timestamps = true;
    protected $fillable = array('image', 'title_en', 'title_ar' , 'status');

    public static $rules = [
        'title_en' => 'required|min:3|max:255',
        'title_ar' => 'required|min:3|max:255',
        'image' => 'required|image',
    ];
    public static $rules2 = [
        'title_en' => 'required|min:3|max:255',
        'title_ar' => 'required|min:3|max:255',
        'image' => 'nullable|image',
    ];
}
