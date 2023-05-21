<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $min = Products::first();
        $max = Products::orderBy('id', 'desc')->first();
        if ($min || $max){
            $single_product = Products::where('id', rand($min->id, $max->id))->first();
        }else{
            $single_product = Products::first();
        }
        $cities = Cities::get();
        $countries = Countries::all();
        $orders = Order::query()->with(['products'])->where('user_id', Auth::id())->get();
//        return $orders;
        $addresses = Address::with(['country', 'cities'])
            ->where('user_id', Auth::id())->get();

        if ($request->ajax()) {
            return view('web.account.address', compact( 'addresses'));
        }
        return view('web.account.index', compact('cities', 'single_product', 'orders', 'countries', 'addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'id_city' => 'nullable|exists:cities,id',
            'avatar' => 'nullable|image',
        ] , ['first_name.required' => __('lang.first_name_required'),
            'last_name.required' => __('lang.last_name_required'),]);

        if ($validator->fails()){
            return redirect()->back()->with('error', __('lang.error'));
        }
        $data = $request->except('avatar');
        if ($request->file('avatar')) {
            $name = Str::random(12);
            $path = $request->file('avatar');
            $name = $name . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $data['avatar'] = $name;
            $path->move('dashboard/images', $name);
        }
        $user->avatar = $data['avatar'] ?? $user->avatar;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->id_city = $request->id_city;
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->back()->with('success', __('lang.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete_address($id)
    {
        $address = Address::find($id);
        $address->delete();

    }

    public function edite_address($id)
    {
        $address = Address::find($id);
        return response()->json($address);
    }

    public function update_address(Request $request , $id)
    {
        $address = Address::find($id);
        $address->update($request->all());
    }


    public function add_address(Request $request)
    {
        $validator = Validator::make($request->all(), Address::$rules);
        if ($validator->fails()){
            return response()->json([
                'error' => $validator->getMessageBag(),
            ]);
        }
        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->country_id = $request->country_id;
        $address->city_id = $request->city_id;
        $address->street = $request->street;
        $address->district = $request->district;
        $address->czip = $request->czip;
        $address->cpobox = $request->cpobox;
        $address->cmobile = $request->cmobile;
        $address->note = $request->note;
        $address->save();
        return "done";
    }

    public function getTracking(Request $request , $id)
    {
        $trackingData  = $this->CallApiSmsa('/getTracking?awbNo='.$id.'&passkey=New@8919' , 'get');
        return view('web.account.trackingOrder' ,  ['Tracking' => $trackingData]);
    }

    public function CallApiSmsa($apiUrl , $type = 'post')
    {
        $headers = [
            'Content-type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
        $response = Http::withHeaders($headers)->get('https://track.smsaexpress.com/SecomRestWebApi/api'.$apiUrl);
        return json_decode($response);
    }
}
