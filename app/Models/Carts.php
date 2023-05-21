<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';

//    protected $primaryKey = 'cookie_id';

    public $timestamps = true;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total',
        'note',
        'status',
        'color',
        'cookie_id',
        'coupon_id',
    ];

//    protected static function booted()
//    {
//        static::observe(CartObserver::class);
//    }

    /**
     * ! Relations
     */

    /**
     * ? User Relation
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'user_name' => 'Anonymous',
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsTo(Colors::class, 'color' , 'id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupons::class, 'coupon_id')->withDefault();
    }
}
