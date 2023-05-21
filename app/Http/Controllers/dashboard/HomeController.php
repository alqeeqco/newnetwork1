<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events_s=Products::count();
        $orders_count=Order::count();

        $date=[];
        $products_s=[];
        $orders=[];
        for ($i = 0; $i < 7; $i++){
//            $range = \Carbon\Carbon::now()->subDays($i)->format('20y-m-d');
            $range = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $product=Products::whereDate('created_at',$range)->get();
            $order=Order::whereDate('created_at',$range)->orderBy('id', 'DESC')->get();
            $date[]=$range;
            $products_s[]=$product->count();
            $orders[]=$order->count();
        }
        return view('dashboard.dashboard',compact('events_s','orders_count','date','products_s','orders'));
    }
}
