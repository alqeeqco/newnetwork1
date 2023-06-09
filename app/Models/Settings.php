<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('key_id', 'title_en', 'title_ar', 'value', 'set_group', 'tax');

}
