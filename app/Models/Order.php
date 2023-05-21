<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'note',
        'status',
        'number',
        'payment_method',
        'payment_status',
        'transaction_id',
        'total',
        'address_id',
        'awbNo',
        'voucherCode',
        'customerId',
        'applicationId',
        'otpID_preRedeem',
        'otpID_preRefund',
        'voucher_id',
        'voucher_amount',
        'voucher_currency',
        'voucher_createdAt',
        'voucher_expiryDate',
        'voucher_status',
        'voucher_applicationId',
        'voucher_transactionId',
        'voucher_timestamp',
    ];

    /**
     * ! Relations
     * ? User Model ( One User Have Many Orders )
     * ? Product Model ( Many Products Have Many Orders )
     * ? Address Model ( One Address Have Many Orders )
     */

    /**
     * ? User Relation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'user_name' => 'Guest',
        ]);
    }

    /**
     * ? Product Relation
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->withPivot([
                'product_name', 'price', 'quantity', 'options',
            ]);
    }

    /**
     * @return HasMany
     */
    public function addresses()
    {
        return $this->belongsTo(Address::class , 'address_id' , 'id');
    }

    protected static function booted()
    {
        static::creating(function(Order $order) {
            // 20230001, 20230002
            $order->number = Order::getNextOrderNumber();
            $order->created_at = now()->addHours(3);
        });
    }

    public static function getNextOrderNumber()
    {
        // SELECT MAX(number) FROM orders
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');

        if( $number ) {
            return $number + 1;
        }

        return $year . '0001';
    }


}
