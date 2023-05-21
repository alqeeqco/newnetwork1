<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartCoupon extends Model
{
    use HasFactory;

    protected $table = 'cart_coupons';

    public $incrementing = false;

    protected $fillable = [
        'cart_id',
        'coupon_id',
        'total',
    ];

    /**
     * ! Relations
     * ? With Cart ( One Cart Have One Coupon )
     * ? With Coupon ( One Coupon Related To Many Carts )
     */

    /**
     * ? Cart Relation
     * @return BelongsTo
     */
    public function cart() : BelongsTo
    {
        return $this->belongsTo(Carts::class, 'cart_id', 'cookie_id');
    }

    /**
     * ? Coupon Relation
     * @return BelongsTo
     */
    public function coupons() : BelongsTo
    {
        return $this->belongsTo(Coupons::class, 'coupon_id', 'id');
    }
}
