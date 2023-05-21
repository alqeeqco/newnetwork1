<?php

namespace App\Observers;

use App\Models\carts;
use App\Models\Products;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the carts "creating" event.
     *
     * @param carts $carts
     * @return void
     */
    public function creating(carts $carts)
    {
        // Check If There Is Coupon ID
        $coupon_exists = Carts::query()->where('cookie_id', $carts->cookie_id)
            ->whereNotNull('coupon_id')->first();

        if( $coupon_exists ) {
            $carts->coupon_id = $coupon_exists->coupon_id;
        }

        $carts->id = Str::uuid();
    }

    /**
     * @param carts $carts
     * @return void
     */
    public function created(carts $carts)
    {
        // Check If There Is Coupon ID
//        $coupon_exists = Carts::query()->where('cookie_id', $carts->cookie_id)
//            ->whereNotNull('coupon_id')->first();
//
//        if( $coupon_exists ) {
//            $single_coupon = Carts::query()->where('cookie_id', $carts->cookie_id)
//                ->whereNotNull('coupon_id')->latest();
//
//            $total = (float)Carts::where('cookie_id', $carts->cookie_id)
//                ->join('products', 'products.id', '=', 'carts.product_id')
//                ->selectRaw('SUM(products.price * carts.quantity) as total')
//                ->value('total');
//
//
//            $discount = $total * ($coupon_exists->coupon->discount / 100);
//
//            $total = $total - $discount;
//
//            $single_coupon->update([
//                'total' => $total,
//            ]);
//        }

    }
    /**
     * Handle the carts "updated" event.
     *
     * @param carts $carts
     * @return void
     */
    public function updated(carts $carts)
    {
        //
    }

    /**
     * Handle the carts "deleted" event.
     *
     * @param carts $carts
     * @return void
     */
    public function deleting(carts $carts)
    {
        dd($carts);
        $carts_object = Carts::where('cookie_id', $carts->cookie_id)->get();
        if( $carts->coupon_id ) {
            $total = (float) Carts::where('cookie_id', $carts_object->cookie_id)
                ->join('products', 'products.id', '=', 'carts.product_id')
                ->selectRaw('SUM(products.price * carts.quantity) as total')
                ->value('total');

            $discount = $total * ( $carts_object->coupon->discount / 100 );

            $total = $total - $discount;

            foreach ($carts_object as $row) {
                $row->update([
                    'total' => $total,
                ]);
            }
        }
    }

    /**
     * Handle the carts "restored" event.
     *
     * @param carts $carts
     * @return void
     */
    public function restored(carts $carts)
    {
        //
    }

    /**
     * Handle the carts "force deleted" event.
     *
     * @param carts $carts
     * @return void
     */
    public function forceDeleted(carts $carts)
    {
        //
    }
}
