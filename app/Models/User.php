<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable =[
        'user_name',
        'email',
        'first_name',
        'last_name',
        'password',
        'avatar',
        'status',
        'id_city',
    ];
    protected $hidden = [
        'password'
    ];
    public static $rules = [
        'email' => 'required|min:3|max:255',
        'user_name' => 'required|min:3|max:255',
    ];
    public static $rules2 = [
        'new_password' => 'required|min:8|max:255',
        'confirm_password' => 'required|min:8|max:255|same:new_password',
    ];
    public function address()
    {
        return $this->hasMany('\App\Models\Address','user_id','id');
    }

    public function city()
    {
        return $this->belongsTo('\App\Models\Cities','id_city','id');
    }

    public function isActive()
    {
        return $this->status == 1;
    }
}
