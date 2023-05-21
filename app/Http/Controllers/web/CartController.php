<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Coupons;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Shippingoptions;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use Carbon\Carbon;
use Cookie;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request, CartRepository $cart)
    {
        $items = $this->cart;

        $shipping_options = Shippingoptions::all();

        $tax = Settings::query()->where('key_id', 'tax')->first();

        $coupon = Carts::query()->with('coupon')->where(function ($query) use ($cart) {
            $query->where('user_id', Auth::id())->orWhere('cookie_id', $cart->getCookieId())->where('status', '1');
        })->whereNotNull('coupon_id')->first();

        if ($request->ajax()) {
            return view('web.cart.table-data', compact('items', 'shipping_options', 'tax', 'coupon'));
        }

        return view('web.cart.index', compact('items', 'shipping_options', 'tax', 'coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $validator = \Validator::make($request->all(), [
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error(__('lang.color_required'));
            return redirect()->back();
        }

        $product_s = Products::where('quantity', '>=', $request->quantity)->whereHas('colors' , function ($q) use ($request){
            $q->where('color' , $request->color)->where('quantity' , '>=', $request->quantity);
        })->find($request->product_id);
//        return  $product_s;
        if ($product_s) {
            $this->cart->add($product_s, $request->color, $request->quantity);
            return redirect()->route('cart.index');
        } else {
            toastr()->error(__('lang.quantity_you'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product = Products::findOrFail($request->post('product_id'));

        $this->cart->update($product, $product->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $tax = Settings::where('key_id', 'tax')->first()->value;
        $cart_fd = Carts::find($id);
        if ($cart_fd->coupon_id != null) {
            $coupon = Coupons::find($cart_fd->coupon_id);
            $product = Products::find($cart_fd->product_id);
            if ($product->discount > 0) {
                $discount = (($product->price * $cart_fd->quantity) - (($product->price * $cart_fd->quantity) * ($product->discount / 100)
                            + (($tax / 100) * ($product->price * $cart_fd->quantity)))) * ($coupon->discount / 100);
                $total_s_x = $discount;
                $Cookie_total = \Illuminate\Support\Facades\Cookie::get('total_ca');
                $total_last = $Cookie_total - $total_s_x;
                Cookie::queue('total_ca', $total_last, 43800);
            } else {
                $discount = (($product->price * $cart_fd->quantity) + (($tax / 100) * ($product->price * $cart_fd->quantity))) * ($coupon->discount / 100);
                $total_s_x = $discount;
                $Cookie_total = Cookie::get('total_ca');
                $total_last = $Cookie_total - $total_s_x;
                Cookie::queue('total_ca', $total_last, 43800);
            }
            $this->cart->delete($id);
        } else {
            $this->cart->delete($id);
        }
        if (Auth::user()){
            $count = Carts::where('user_id', Auth::user()->id)->count();
        }else{
            $count = Carts::where('cookie_id', $this->cart->getCookieId())->count();
        }
        return response()->json([
            'count' => $count,
            'total' => $this->cart->total(),
        ]);
    }

    public function coupon(Request $request)
    {
        $tax = Settings::where('key_id', 'tax')->first()->value;
        $cart = Carts::query()->where('cookie_id', $this->cart->getCookieId())
            ->whereNotNull('coupon_id');
        if ($cart->first()) {
            $coupon = Coupons::where('id', $cart->first()->coupon_id)->first();
            $discount = $this->cart->total() * ($coupon->discount / 100);
            $total = $this->cart->total() + $discount;
            $meassge = __('lang.Your_cart_empty');
            $carta = Carts::query()->where('cookie_id', $this->cart->getCookieId())
                ->whereNotNull('coupon_id');
            foreach ($carta->get() as $row) {
                $product = Products::find($row->product_id);
                if ($product->discount > 0) {
                    $total = (($product->price * $row->quantity) - (($product->price * $row->quantity) * ($product->discount / 100)
                            + (($tax / 100) * ($product->price * $row->quantity))));
//                    $discount =  (($product->price * $row->quantity) - (($product->price * $row->quantity) * ($product->discount / 100)
//                                + (($tax/100) * ($product->price * $row->quantity)))) * ($coupon->discount / 100);
//                    $total = $total - $discount;
                } else {
                    $total = (($product->price * $row->quantity) + (($tax / 100) * ($product->price * $row->quantity)));
//                    $discount =  (($product->price * $row->quantity) + (($tax/100) * ($product->price * $row->quantity))) * ($coupon->discount / 100);
//                    $total = $total - $discount;
                }
                $row->update([
                    'coupon_id' => NULL,
                    'total' => $total,
                ]);
            }
            return response()->json([
                'cart' => 'emptyCoupon',
                'total' => $this->cart->total(),
                'meassge' => $meassge,
            ]);
        }

        $coupon = Coupons::where('code', $request->coupon)->first();

        if ($coupon) {

            if ($coupon->end_at < Carbon::now()) {
                $meassge = __('lang.Your_cart_empty');
                return response()->json([
                    'cart' => 'coupon_end',
                    'meassge' => $meassge,
                ]);
            }

            if ($coupon->minimum > $this->cart->total() || $coupon->maximum < $this->cart->total()) {
//                toastr()->error('This Coupon Not In Range');

                $meassge = __('lang.Your_cart_empty');
                return response()->json([
                    'cart' => 'cart_range',
                    'meassge' => $meassge,
                ]);
            }

//            $discount = $this->cart->total() * ($coupon->discount / 100);
//
//            $total = $this->cart->total() - $discount;
//            {{ __('lang.sar').' '.number_format(($item->product->price * $item->quantity) + (($tax_tax/100) * ($item->product->price * $item->quantity)) , 2)  }}
            $cart = Carts::query()->where('cookie_id', $this->cart->getCookieId());
            $total_ca = $cart->sum('total');
            $total_ca = (($total_ca) * ($coupon->discount / 100));
            foreach ($cart->get() as $row) {
                $product = Products::find($row->product_id);
                if ($product->discount > 0) {
                    $total = (($product->price * $row->quantity) - (($product->price * $row->quantity) * ($product->discount / 100)
                            + (($tax / 100) * ($product->price * $row->quantity))));
                    $discount = (($product->price * $row->quantity) - (($product->price * $row->quantity) * ($product->discount / 100)
                                + (($tax / 100) * ($product->price * $row->quantity)))) * ($coupon->discount / 100);
                    $total = $total - $discount;
                } else {
                    $total = (($product->price * $row->quantity) + (($tax / 100) * ($product->price * $row->quantity)));
                    $discount = (($product->price * $row->quantity) + (($tax / 100) * ($product->price * $row->quantity))) * ($coupon->discount / 100);
                    $total = $total - $discount;
                }
                Cookie::queue('total_ca', $total_ca, 43800);
                $row->update([
                    'coupon_id' => $coupon->id,
                    'total' => $total,
                ]);
            }
            $meassge = __('lang.Discount_done');
            return response()->json([
                'cart' => 'coupon_done',
                'meassge' => $meassge,
                'total' => $this->cart->total(),
                'total_ca' => $total_ca,
            ]);
//            toastr()->success('The discount has been added successfully');
            return response()->json($total);
//            return redirect()->back();
        } else {
            $meassge = __('lang.Code_not_found');
            return response()->json([
                'cart' => 'coupon_empty',
                'meassge' => $meassge,
            ]);
//            toastr()->error('Coupon Not Found');
//            return redirect()->back();
        }
//        return $this->cart->coupon($request);
//        return response()->json([
//            'total' => $this->cart->total(),
//        ]);
    }

    /**
     * @return JsonResponse
     */
    public function empty()
    {
        $this->cart->empty();
        return response()->json([
            'total' => $this->cart->total(),
        ]);
    }

    public function update_cart(Request $request, $id)
    {
        $cart = Carts::with('product')->find($id);
        $product = Products::find($cart->product_id);
        if ($product->quantity < $request->quantity) {
            return response()->json([
                'status' => 404,
                'quantity' => $product->quantity,
            ]);
        }elseif ($request->quantity == 0){
            return response()->json([
                'status' => 1000,
                'quantity' => 1,
            ]);
        } else {
            $tax = Settings::where('key_id', 'tax')->first()->value;
            $cart->update([
                'quantity' => $request->quantity,
            ]);
//            $total = ($product->price * $cart->quantity) + (($product->tax / 100) * ($product->price * $cart->quantity));
//            if($product->discount > 0){
//                $total = ($cart->quantity * $product->price) - ($product->price * ($product->discount/100)) + ($tax / 100 * ($product->price * $cart->quantity));
//            } else{
//                $total = ($cart->quantity * $product->price) + ($tax / 100 * ($product->price * $cart->quantity));
//            }
            if ($cart->coupon_id != null) {
                $coupon = Coupons::find($cart->coupon_id);
                if ($product->discount > 0) {
                    $total = (($product->price * $cart->quantity) - (($product->price * $cart->quantity) * ($product->discount / 100)
                            + (($tax / 100) * ($product->price * $cart->quantity))));
                    $discount = (($product->price * $cart->quantity) - (($product->price * $cart->quantity) * ($product->discount / 100)
                                + (($tax / 100) * ($product->price * $cart->quantity)))) * ($coupon->discount / 100);
                    $total = $total - $discount;


                    $discount_sco = (($product->price * (1)) - (($product->price * (1)) * ($product->discount / 100)
                                + (($tax / 100) * ($product->price * (1))))) * ($coupon->discount / 100);
                    $total_s_x = $discount_sco;
                    $Cookie_total = Cookie::get('total_ca');
                    if ($request->type == '+'){
                        $total_last = $Cookie_total + $total_s_x;
                    } else{
                        $total_last = $Cookie_total - $total_s_x;
                    }

                    Cookie::queue('total_ca', $total_last, 43800);
                } else {
                    $total = (($product->price * $cart->quantity) + (($tax / 100) * ($product->price * $cart->quantity)));
                    $discount = (($product->price * $cart->quantity) + (($tax / 100) * ($product->price * $cart->quantity))) * ($coupon->discount / 100);
                    $total = $total - $discount;

                    $discount_sco = (($product->price * (1)) + (($tax / 100) * ($product->price * (1)))) * ($coupon->discount / 100);
                    $total_s_x = $discount_sco;
                    $Cookie_total = Cookie::get('total_ca');
                    if ($request->type == '+'){
                        $total_last = $Cookie_total + $total_s_x;
                    } else{
                        $total_last = $Cookie_total - $total_s_x;
                    }
                    Cookie::queue('total_ca', $total_last, 43800);
                }
            } else {
//                $total = ($product->price * $cart->quantity) + (($product->tax / 100) * ($product->price * $cart->quantity));
                if ($product->discount > 0) {
                    $total = ($cart->quantity * $product->price) - ($product->price * ($product->discount / 100)) + ($tax / 100 * ($product->price * $cart->quantity));
                } else {
                    $total = ($cart->quantity * $product->price) + ($tax / 100 * ($product->price * $cart->quantity));
                }
            }

            // return $total;

            $cart->update([
                'total' => $total,
                // 'total' => 0,
            ]);

            return response()->json([
                'total' => $this->cart->total(),
                'quantity' => $product->quantity,
            ]);
        }

    }

    public function update_Shipping(Request $request)
    {
        return response()->json([
            'total' => $this->cart->total(),
        ]);
    }
}
