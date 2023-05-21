<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Shippingoptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()->with(['user', 'products', 'addresses.cities.countries'])->orderBy('id' , 'desc')
//            ->when($request->user_name, function ($q) use ($request) {
//                $q->whereHas('user' , function ($query) use ($request){
//                    $query->where('user_name', $request->user_name);
//                });
//            })
            ->get();

        if ( $request->ajax() ) {
            return view('dashboard.orders.table-data', compact('orders'))->render();
        }
        return view('dashboard.orders.index', compact('orders'));
    }
    public function print($id){
        $orders = Order::where('number' , $id)->with('user', 'products', 'addresses.cities.countries')->first();
//        return $orders;
        return view('dashboard.orders.PrintOrder' , compact('orders'));
    }
}
