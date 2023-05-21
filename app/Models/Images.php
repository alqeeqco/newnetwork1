<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    protected $table = 'images';
    public $timestamps = false;
    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'image',
    ];

    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable()
    {
        return $this->morphTo();
    }

}
