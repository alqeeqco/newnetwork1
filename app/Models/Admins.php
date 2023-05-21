<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admins extends Authenticatable
{
    use HasRoles;

    protected $guard_name = 'admin';

    protected $table = 'admins';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'avatar',
        'name',
        'password',
        'status',
    ];

    // Accessors For Image_Path
    public function getImageAttribute()
    {
        if (!$this->avatar){
            return asset('dashboard/assets/images/default-avatar.png');
        }

        return \Illuminate\Support\Facades\Request::root() . '/dashboard/images/' . $this->avatar;
    }

}
