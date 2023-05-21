<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Carts;
use App\Models\Colors;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Settings;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TapPaymentController extends Controller
{
    public function create($id, CartRepository $cart)
    {
        $apiURL = 'https://api.tap.company';
//        $apiKey = 'sk_test_VE3C5q9UrZWKvkPFpQ2dAwje';
        $apiKey = 'sk_live_D82gPxw5K3NYpsZQia0zhTBM';

        $order = Order::find($id);

        $postFields = [
            //Fill required data
            'amount' => $order->total,
            'currency' => 'SAR',
            'save_card'    => false,
            'description'    => '',
            'statement_descriptor'    =>  '',
            'metadata' => [
                'udf1' => 'test 1',
                'udf2' => 'test 2',
            ],

            'reference' => [
                'transaction' => 'txn_0001',
                'order'    => 'id',
            ],
            'receipt'    =>  [
                'email'    => false,
                'sms'    => false,
            ],
            'customer'    =>  [
                'first_name' => $order->user->first_name ?? $order->user->user_name,
                'phone'    => [
                    'country_code'    => '966',
                    'number'    => '123132',
                ],
            ],
            'merchant'    =>  [
                'id'    => '',
            ],
            'source'    =>  [
//                'id'    => 'src_kw.knet',
//                'id'    => 'src_card',
                'id'    => 'src_all',
            ],
            'post'    =>  [
                'url'    =>  route('home'),
            ],
            'redirect' => [
                'url' => route('tap.paymentStatus', ['id' => $order->id]),
            ],
            'ProductName' => '123',
            'ProductPrice' => '123',
            'ProductQty' => '132',

        ];

        $data = $this->executePayment($apiURL , $apiKey , $postFields);


        if( $data->status == 'INITIATED' ) {

            $order->update([
                'transaction_id' => $data->id,
                'payment_status' => 'pending',
            ]);

            $data->redirect->url = route('tap.paymentStatus', ['id' => $order->id ] );

            return redirect( $data->transaction->url );
        };
    }

    public function getPayment($id , CartRepository $cart)
    {

        $apiURL = 'https://api.tap.company';
//        $apiKey = 'sk_test_VE3C5q9UrZWKvkPFpQ2dAwje';
        $apiKey = 'sk_live_D82gPxw5K3NYpsZQia0zhTBM';

        $user = Auth::user();
        $order = Order::with('addresses.cities.countries')->find($id);
        $location = Settings::where('key_id' , 'location_ar')->first()->value;
        $phone = Settings::where('key_id' , 'phone')->first()->value;
        $total_quantity = Carts::with('product')->whereHas('product', function($query) { $query->where('status', 1);})->where('user_id', Auth::user()->id)->sum('quantity');
        $postFieldsSmsa = [
            'passkey' => 'New@8919',
            'refno' => $order->id."12453",
            'sentDate' => now(),
            'idNo' => $order->id,
            'cName' => $user->user_name,
            'cntry' => $order->addresses->cities->countries->name_ar,
            'cCity' => $order->addresses->cities->name_ar,
            "cZip" => $order->addresses->czip, // Postal code
            "cPOBox" => $order->addresses->cpobox, // Postal box
            'cMobile' => $order->addresses->cmobile,// Mobile number
            // 'cntry' => 'Saudi Arabia',
            // 'cCity' => 'Riyadh',
            // "cZip" => '12271', // Postal code
            // "cPOBox" => '12298', // Postal box
            // 'cMobile' => '966509395939',// Mobile number
            "cTel1" => "",
            "cTel2" => "",
            // 'cAddr1' => 'Al Fadl Al Amiri',
            // 'cAddr2' => 'حي العليا',
            'cAddr1' => $order->addresses->street,
            'cAddr2' => $order->addresses->district,
            'shipType' => 'DLV',
            'PCs' => $total_quantity, // total_quantity
            'cEmail' => $user->email,
            "carrValue" => "",
            "carrCurr" => "",
            'codAmt' => 0,
            'weight' => '0.500',
            'itemDesc' => "",
            "custVal" => "",
            "custCurr" => "",
            "insrAmt" => "",
            "insrCurr" => "",
            'sName' => 'NEW NETWORK COMPANY',
            'sContact' => 'KHALED',
            'sAddr1' => $location,
            // 'sAddr1' => 'Riyadh 13224, Saudi Arabia',
            'sAddr2' => '',
            'sCity' => 'Riyadh',
            'sPhone' => $phone,
            'sCntry' => 'Saudi Arabia',
            "prefDelvDate" => "",
            "gpsPoints" => "",
        ];
        $json = $this->callAPI("$apiURL/v2/charges/$order->transaction_id", $apiKey , [] , 'GET');
        if ($json->status == 'INITIATED'){
            $order->payment_status = 'pending';
        }elseif ($json->status == 'CAPTURED'){
            $smsa = $this->CallApiSmsa('/addship' , $postFieldsSmsa);
            $awbNo = $smsa;
            $order->update(['awbNo' => $awbNo]);
            $cart->empty();
            toastr()->success(__('lang.order_done'));
            $order->payment_status = 'paid';
            $OrderItem = OrderItem::whereHas('order' , function ($q) use($order){
                $q->where('order_id' , $order->id);
            })->get();
            foreach ($OrderItem as $items){
                $product_s = Products::with('colors')->find($items->product_id);
                $product_s->update([
                    'quantity' => $product_s->quantity - $items->quantity,
                ]);
                $colors = Colors::where('product_id' , $items->product_id)->where('color' , $items->options)->first();
//                return $colors;
                $colors->update([
                    'quantity' => $colors->quantity - $items->quantity,
                ]);
            }
            Mail::to(Auth::user()->email)->send(new OrderMail($order));
        }elseif ($json->status == 'DECLINED'){

            $cart->empty();
            toastr()->error(__('lang.order_failed_pay'));
            $order->payment_status = 'failed';
        }else{
            $order->payment_status = 'failed';
            toastr()->error(__('lang.order_failed'));
        }
        $order->save();
        return redirect('/');
    }
    function executePayment($apiURL, $apiKey, $postFields)
    {
        $json = $this->callAPI("$apiURL/v2/charges", $apiKey, $postFields);
        return $json;
    }

    function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {
        $curl = curl_init($endpointURL);

        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_POSTFIELDS => json_encode($postFields),
            CURLOPT_HTTPHEADER => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            dd($response);
            return json_decode($response);

        }
    }







    public function CallApiSmsa($apiUrl , $postFields , $type = 'post')
    {
        $headers = [
            'Content-type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
        if($type == 'get'){
            $response = Http::withHeaders($headers)->get('https://track.smsaexpress.com/SecomRestWebApi/api'.$apiUrl , $postFields);
            return json_decode($response);
        }elseif($type == 'post'){
        $response = Http::withHeaders($headers)->post('https://track.smsaexpress.com/SecomRestWebApi/api'.$apiUrl , $postFields);
            return json_decode($response);
        }else{
            abort(403);
        }
    }
}
