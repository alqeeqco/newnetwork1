<?php

namespace App\Repositories\Cart;


use App\Models\CartCoupon;
use App\Models\Carts;
use App\Models\Coupons;
use App\Models\Products;
use App\Models\Settings;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartRepository implements CartInterface
{
    public function get(): Collection
    {
        if( Auth::check() ) {
            return Carts::query()->with('product')
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->where('user_id', Auth::user()->id)->get();
        }else{
            return Carts::query()->with('product')
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->where('cookie_id', $this->getCookieId())->get();
        }
    }

    public function add(Products $product, $color, $quantity = 1)
    {
        $tax = Settings::where('key_id' , 'tax')->first()->value;
        $item = Carts::where('product_id', $product->id)
            ->whereHas('product', function($query) {
                $query->where('status', 1);
            })
            ->where('color', $color)
            ->where('user_id', Auth::id())
            ->where('cookie_id', $this->getCookieId())
            ->first();


        if (!$item){
            $carts_s = Carts::where('user_id', '=' , Auth::id())
                ->orwhere('cookie_id', '=' , $this->getCookieId())->first();
            if ($carts_s){
                if ($carts_s->coupon_id == null){
//                    return "add normal";
                    if($product->discount > 0){
                        $total = ($quantity * $product->price) - ($product->price * ($product->discount/100))
                            + ($tax / 100 * ($product->price * $quantity));
                    }
                    else{
                        $total = ($quantity * $product->price) + ($tax / 100 * ($product->price * $quantity));
                    }
                    $cart_x = new Carts();
                    $cart_x->cookie_id = $this->getCookieId();
                    $cart_x->user_id = Auth::id();
                    $cart_x->product_id = $product->id;
                    $cart_x->quantity = $quantity;
                    $cart_x->total = $total;
                    $cart_x->color = $color;
                    $cart_x->save();
                    // add normal
                }
                else{
//                    return "add cart and discount";
                    $coupon = Coupons::find($carts_s->coupon_id);
                    if ($product->discount > 0){
                        $total_s =  (($product->price * $quantity) - (($product->price * $quantity) * ($product->discount / 100)
                                + (($tax/100) * ($product->price * $quantity))));
                        $discount =  (($product->price * $quantity) - (($product->price * $quantity) * ($product->discount / 100)
                                    + (($tax/100) * ($product->price * $quantity)))) * ($coupon->discount / 100);
                        $total_s_x = $discount;
                        $Cookie_total = Cookie::get('total_ca');
                        $total_last = $total_s_x + $Cookie_total;
                        Cookie::queue('total_ca' , $total_last , 43800);
                        $total_s = $total_s - $discount;
                    }else{
                        $total_s =  (($product->price * $quantity) + (($tax/100) * ($product->price * $quantity)));
                        $discount =  (($product->price * $quantity) + (($tax/100) * ($product->price * $quantity))) * ($coupon->discount / 100);
                        $total_s_x = $discount;
                        $Cookie_total = Cookie::get('total_ca');
                        $total_last = $total_s_x + $Cookie_total;
                        Cookie::queue('total_ca' , $total_last , 43800);
                        $total_s = $total_s - $discount;
                    }

                    $cart_xx = new Carts();
                    $cart_xx->cookie_id = $this->getCookieId();
                    $cart_xx->user_id = Auth::id();
                    $cart_xx->product_id = $product->id;
                    $cart_xx->quantity = $quantity;
                    $cart_xx->total = $total_s;
                    $cart_xx->color = $color;
                    $cart_xx->coupon_id = $carts_s->coupon_id;
                    $cart_xx->save();
                    // add cart and discount
                }
            }
            else{
                if($product->discount > 0){
                    $total = ($quantity * $product->price) - ($product->price * ($product->discount/100))
                        + ($tax / 100 * ($product->price * $quantity));
                }
                else{
                    $total = ($quantity * $product->price) + ($tax / 100 * ($product->price * $quantity));
                }
                $cart_x = new Carts();
                $cart_x->cookie_id = $this->getCookieId();
                $cart_x->user_id = Auth::id();
                $cart_x->product_id = $product->id;
                $cart_x->quantity = $quantity;
                $cart_x->total = $total;
                $cart_x->color = $color;
                $cart_x->save();
                // add normal
            }
        }else{
            return "nothing";
            // nothing
        }






//        if ( Auth::check() ) {
//            $item = Carts::where('product_id', $product->id)
//                ->whereHas('product', function($query) {
//                    $query->where('status', 1);
//                })
//                ->where('color', $color)
//                ->where('user_id', Auth::id())
//                ->first();
//        }else {
//            $item = Carts::where('product_id', $product->id)
//                ->whereHas('product', function($query) {
//                    $query->where('status', 1);
//                })
//                ->where('color', $color)
//                ->where('cookie_id', $this->getCookieId())
//                ->first();
//        }
//
//        if($product->discount > 0){
//            $total = ($quantity * $product->price) - ($product->price * ($product->discount/100))
//                + ($tax / 100 * ($product->price * $quantity));
//        }
//        else{
//            $total = ($quantity * $product->price) + ($tax / 100 * ($product->price * $quantity));
//        }
//        if (!$item) {
//            $item = Carts::where('user_id', Auth::id())
//                ->where('cookie_id', $this->getCookieId())
//                ->where('coupon_id', '!=' , null)
//                ->first();
//            if ($item){
//                $cart = new Carts();
//                $cart->cookie_id = $this->getCookieId();
//                $cart->user_id = Auth::id();
//                $cart->product_id = $product->id;
//                $cart->quantity = $quantity;
//                $cart->total = $total;
//                $cart->color = $color;
//                $cart->save();
//            }else{
//                return Carts::create([
//                    'cookie_id' => $this->getCookieId(),
//                    'user_id' => Auth::id(),
//                    'product_id' => $product->id,
//                    'quantity' => $quantity,
//                    'total' => round($total),
//                    'color' => $color,
//                ]);
//            }
//        }

//        $item->increment('quantity', $quantity);

//        self::getTotalAfterCoupon();

    }

    public function update(Products $product, $quantity)
    {
        Carts::where('product_id', $product->id)
            ->where('cookie_id', $this->getCookieId())
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        // Delete
        if ( Auth::check() ) {
            Carts::where('id', $id)->where('user_id', Auth::id())->delete();

        }else {
            Carts::where('id', $id)->where('cookie_id', $this->getCookieId())->delete();
        }

        self::total();

        // Check If There Is Coupon ID
        self::getTotalAfterCoupon();
    }


    public function coupon(\Illuminate\Http\Request $request)
    {
//        if ( $this->get()->count() == 0 ) {
////            toastr()->error('You Do Not Have Product Yet');
////            return redirect()->back();
//            $meassge = __('lang.Your_cart_empty');
//            return response()->json([
//                'cart' => 'empty',
//                'meassge' => $meassge,
//            ]);
//        }

        $cart = Carts::query()->where('cookie_id', $this->getCookieId())
            ->whereNotNull('coupon_id')->first();
        $cart2 = Carts::query()->where('cookie_id', $this->getCookieId())
            ->whereNotNull('coupon_id')->get();
//        return $cart2;
        if ($cart) {
            $coupon = Coupons::where('id', $cart->coupon_id)->first();
            $cart->update([
                'coupon_id' => NULL,
            ]);
            $discount = $this->total() * ($coupon->discount / 100);
            $total = $this->total()  + $discount;
            $meassge = __('lang.Your_cart_empty');
//            return response()->json([
//            'cart' => 'emptyCoupon',
//            'total' => round($total),
//            'meassge' => $meassge,
//            ]);
        }

        $coupon = Coupons::where('code', $request->coupon)->first();

        if ($coupon) {

            if ($coupon->end_at < Carbon::now()) {
//                toastr()->error('This Coupon Has Been Expired');
                return redirect()->back();
            }

            if ($coupon->minimum > $this->total() || $coupon->maximum < $this->total()) {
//                toastr()->error('This Coupon Not In Range');
                return redirect()->back();
            }

            $discount = $this->total() * ($coupon->discount / 100);

            $total = $this->total() - $discount;

            foreach ($this->get() as $row) {
                $row->update([
                    'coupon_id' => $coupon->id,
                    'total' => $total,
                ]);
            }

//            toastr()->success('The discount has been added successfully');
            return response()->json($total);
//            return redirect()->back();
        }
        else {
//            toastr()->error('Coupon Not Found');
            return redirect()->back();
        }
    }

    public function empty()
    {
        Carts::where('cookie_id', $this->getCookieId())->delete();
    }

    public function total(): float
    {
        $tax = Settings::where('key_id' , 'tax')->first()->value ?? 0;
        if( Auth::check() ) {
            $cart = Carts::query()->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->where('user_id', Auth::id())
                ->where('coupon_id' , '!=' , null);

            if( $cart->first() ) {
//                $coupon = Coupons::find($cart->coupon_id) ?? 0;
//                $total = $cart->total - ($cart->total * ($coupon->discount / 100));
                return $cart->sum('total');
            }else{
//                {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}
//                {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) - (($item->product->price * $item->quantity) *
//                  $item->product->discount/100) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}


//                $total = Carts::whereHas('product', function($query) {
//                    $query->where('status', 1);
//                    })->where('user_id', Auth::id());

                return (float) Carts::query()->whereHas('product', function($query) {
                        $query->where('status', 1);
                    })
                    ->where('user_id', Auth::id())
                    ->join('products', 'products.id', '=', 'carts.product_id')
//                    ->selectRaw('SUM(products.price * carts.quantity + ((products.tax / 100) * (products.price * carts.quantity))) as total')
//                    ->selectRaw('SUM(products.price * carts.quantity + (('.$tax.'/ 100) * (products.price * carts.quantity))) as total')
                    ->selectRaw('SUM(CASE WHEN products.discount > 0 THEN (products.price * carts.quantity - ((products.price * carts.quantity)
                    * products.discount / 100) + (('.$tax.'/ 100) * (products.price * carts.quantity)) ) ELSE
                    products.price * carts.quantity + (('.$tax.'/ 100) * (products.price * carts.quantity)) END) as total')
//                    ->selectRaw('(CASE WHEN products.discount = 0 THEN 1 ELSE
//                    SUM(products.price * carts.quantity + (('.$tax.'/ 100) * (products.price * carts.quantity))) as total END) as total2')
                    ->value('total');
//                + ((products.tax / 100) * (products.price * carts.quantity))
            }

        } else {
            $cart = Carts::query()->where('cookie_id', $this->getCookieId())
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->whereNotNull('coupon_id');
        }
        if (  $cart->first() ) {
//            $coupon = Coupons::find($cart->coupon_id) ?? 0;
//            $total = $cart->total - ($cart->total * ($coupon->discount / 100));
//            $total = $cart->total;
            return $cart->sum('total');
        } else {
            return (float) Carts::where('cookie_id', $this->getCookieId())
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->join('products', 'products.id', '=', 'carts.product_id')
//                ->selectRaw('SUM(products.price * carts.quantity) + ((products.tax / 100) * (products.price * carts.quantity)) as total')
//                ->selectRaw('SUM(products.price * carts.quantity + ((products.tax / 100) * (products.price * carts.quantity))) as total')
                ->selectRaw('SUM(CASE WHEN products.discount > 0 THEN (products.price * carts.quantity - ((products.price * carts.quantity)
                    * products.discount / 100) + (('.$tax.'/ 100) * (products.price * carts.quantity)) ) ELSE
                    products.price * carts.quantity + (('.$tax.'/ 100) * (products.price * carts.quantity)) END) as total')
                ->value('total');
        }

    }

    public function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');

        if (!$cookie_id) {
            $cookie_id = Str::uuid();

            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }

        return $cookie_id;
    }

    protected function getTotalAfterCoupon()
    {
        if( Auth::check() ) {
            $coupon_exists = Carts::query()
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->where('user_id', Auth::id())
                ->whereNotNull('coupon_id')->get();
        }else{
            // Check If There Is Coupon ID
            $coupon_exists = Carts::query()->where('cookie_id', $this->getCookieId())
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->whereNotNull('coupon_id')->get();
        }



        if ($coupon_exists->count() > 0) {
            $total = (float) Carts::where('cookie_id', $this->getCookieId())
                ->whereHas('product', function($query) {
                    $query->where('status', 1);
                })
                ->join('products', 'products.id', '=', 'carts.product_id')
                ->selectRaw('SUM(products.price * carts.quantity) as total')
                ->value('total');


            $discount = $total * ($coupon_exists[0]->coupon->discount / 100);

            $total = $total - $discount;

            foreach ( $coupon_exists as $coupon ) {
                $coupon->update([
                    'total' => $total,
                ]);
            }
        };
    }
}
