<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Carts;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Shippingoptions;
use App\Repositories\Cart\CartRepository;
use http\Client\Curl\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Throwable;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Order-List', ['only' => ['index']]);
        $this->middleware('permission:Order-Delete', ['only' => ['destroy']]);
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $orders = Order::query()->with(['user', 'products', 'addresses'])->get();
        $shipping_options = Shippingoptions::all();
        $addresses = Address::with(['country', 'cities'])->where('user_id', Auth::id())->orderBy('id' , 'DESC')->get();
        if ( $request->ajax() ) {
            return view('dashboard.orders.table-data', compact('orders', 'shipping_options', 'addresses'))->render();
        }

        return view('dashboard.orders.index', compact('orders', 'shipping_options', 'addresses'));
    }

    /**
     * @param CartRepository $cart
     * @return string
     */
    public function create(Request $request, CartRepository $cart)
    {


        $carts_s = Carts::where('user_id' , Auth::user()->id)->get();
        foreach ( $carts_s as $item ) {
            $product_s = Products::with('colors')->find($item->product_id);
            foreach ($product_s->colors as $colors){
                if ($colors->color == $item->color){
                    if ($colors->quantity < $item->quantity){
                        toastr()->error(__('lang.quantity_you'));
                        return redirect(app()->getLocale().'/cart');
                    }
                }
            }
        }
        if ($request->ajax()) {
            return view('web.order.address-list', [
                'addresses' => Address::query()->with(['country', 'cities'])->where('user_id', Auth::id())->orderBy('id' , 'desc')->get(),
                'countries' => Countries::all(),
                'cities' => Cities::all(),
            ])->render();
        }
        return view('web.order.create', [
            'cart' => $cart,
            'tax' => Settings::query()->where('key_id', 'tax')->first(),
            'shipping_options' => Shippingoptions::all(),
            'addresses' => Address::query()->with(['country', 'cities'])->where('user_id', Auth::id())->orderBy('id' , 'desc')->get(),
            'countries' => Countries::all(),
            'cities' => Cities::all(),
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        if( $cart->get()->count() == 0 ) {
            return redirect()->route('home');
        }

        $validator = \Validator::make($request->all(), [
            'address_id' => 'required',
        ]);

        if ( $validator->fails() ) {
            toastr()->error('You Do Not Have Address');
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            if($cart->total() == $request->total){

                if($request->payment_method == 'emkan'){
                    $payment = 'Emkan';
                }elseif($request->payment_method == 'tap'){
                    $payment = 'Tab';
                }else{
                    $payment = 'Tab';
                }
            $order = Order::create([
                'user_id' => Auth::id() ?? null,
                'note' => $request->note,
                'payment_method' => $payment,
                'total' => $request->total,
                'address_id' => (int) $request->address_id,
            ]);

            foreach ( $cart->get() as $item ) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name_en,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'options' => $item->color,
                ]);
            }

            DB::commit();
            if($order->payment_method == 'Emkan'){
                return redirect()->route('emcan.create', ['id' => $order->id]);
            }else{
                return redirect()->route('tap.create', ['id' => $order->id]);
            }
        }else{
            toastr()->error(__('lang.something_went_wrong'));
            return redirect()->route('home');
        }
        }catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        // Then Return To Tab Payment
    }

    public function show($user_name , $id){
        $order = Order::with('user' , 'products' , 'addresses.cities.countries')->whereHas('user' , function ($q) use ($user_name){
            $q->where('user_name' , $user_name);
        })->where('id' , $id)->first();
        if ($order){
            return view('web.order.pdf', compact('order'));
        }else{
            abort(403);
        }

    }

    public function destroy($id)
    {
        $order = Order::find($id)->delete();
    }
}
