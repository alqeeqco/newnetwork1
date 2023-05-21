<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specifications extends Model
{
    use HasFactory;

    protected $fillable = array('title_en', 'title_ar', 'option_en', 'option_ar', 'other_option_en', 'other_option_ar', 'product_id');

}
