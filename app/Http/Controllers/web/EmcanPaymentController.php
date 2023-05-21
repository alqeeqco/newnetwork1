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
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class EmcanPaymentController extends Controller
{
    public function create(Request $request, $id)
    {
        return view('web.order.emcan.index');
    }

    public function store(Request $request, $id)
    {
        // return $request->all();
        $order = Order::find($id);
        if ($order) {
            // Start getVoucherDetails
            $postFieldsDetails = [
                // 'voucherCode' => 'XPhscRAVRzhPqKi4',
                // 'customerId' => '171508197',
                // 'applicationId' => '1933605',
                'voucherCode' => $request->voucherCode,
                'customerId' => $request->customerId,
                'applicationId' => $request->applicationId,
            ];
            $responseDetails = $this->CallApi('/merchant/v1/vouchers/getVoucherDetails', $postFieldsDetails);
            $statusDetails = $responseDetails->getStatusCode();
            $getVoucherDetails = json_decode($responseDetails);
            // return $getVoucherDetails;
            //cases: REFUNDED CREATED USED 
            if ($statusDetails == 200) {
                if ($getVoucherDetails->status == 'CREATED') {
                    if ($getVoucherDetails->amount >= $order->total) {
                        $order->update([
                            // 'voucherCode' => 'XPhscRAVRzhPqKi4',
                            // 'customerId' => '1714508197',
                            // 'applicationId' => '1933605',
                            'voucherCode' => $request->voucherCode,
                            'customerId' => $request->customerId,
                            'applicationId' => $request->applicationId,
                        ]);
                    } else {
                        $order->update([
                            'payment_status' => 'failed',
                        ]);
                        toastr()->error(__('lang.The_order_cannot_be_divided'));
                        return redirect()->back();
                    }
                } else {
                    $order->update([
                        'payment_status' => 'failed',
                    ]);
                    toastr()->error(__('lang.The_order_cannot_be_divided'));
                    return redirect()->back();
                }
            } else {
                // return $getVoucherDetails;
                $order->update([
                        'payment_status' => 'failed',
                    ]);
                toastr()->error($getVoucherDetails->message);
                //  toastr()->error(__('lang.warning'));
                return redirect()->back();
            }
            // End getVoucherDetails

            // Start preRedeem
            $postFieldspreRedeem = [
                'customerId' => $order->customerId,
            ];
            $responsepreRedeem = $this->CallApi('/merchant/v1/vouchers/preRedeem', $postFieldspreRedeem);
            $statuspreRedeem = $responsepreRedeem->getStatusCode();
            $preRedeem = json_decode($responsepreRedeem->body());
            if ($statuspreRedeem == 200) {
                $order->update([
                    'otpID_preRedeem' => $preRedeem->otpID,
                ]);
            } else {
                $order->update([
                        'payment_status' => 'failed',
                    ]);
                toastr()->error($preRedeem->message);
                return redirect('/');
            }
            // End preRedeem
            return redirect()->route('emcan.otp_show', $order->id);
        } else {
            $order->update([
                'payment_status' => 'failed',
            ]);
            toastr()->error(__('lang.warning'));
            return redirect('/');
        }
    }

    public function otp_show($id)
    {
        return view('web.order.emcan.otp');
    }

    public function otp(Request $request, CartRepository $cart, $id)
    {
        $user = Auth::user();
        if($user){
            $order = Order::with('addresses.cities.countries')->find($id);
            if ($order) {
                $location = Settings::where('key_id', 'location_ar')->first()->value;
                $phone = Settings::where('key_id', 'phone')->first()->value;
                $total_quantity = Carts::with('product')->whereHas('product', function ($query) {
                    $query->where('status', 1);
                })->where('user_id', $user->id)->sum('quantity');
                $otp =  $request->F1 . $request->F2 . $request->F3 . $request->F4;
                $postFieldsSmsa = [
                    'passkey' => 'New@8919',
                    'refno' => $order->id . "12453",
                    'sentDate' => now(),
                    'idNo' => $order->id,
                    'cName' => $user->user_name,
                    'cntry' => $order->addresses->cities->countries->name_ar,
                    'cCity' => $order->addresses->cities->name_ar,
                    "cZip" => $order->addresses->czip, // Postal code
                    "cPOBox" => $order->addresses->cpobox, // Postal box
                    'cMobile' => $order->addresses->cmobile, // Mobile number
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
                $postFieldsredeem = [
                    'customerId' => $order->customerId,
                    'voucherCode' => $order->voucherCode,
                    'transactionId' => 'Shabaka-'.$order->id,
                    'otp' => $otp,
                    'otpID' => $order->otpID_preRedeem,
                ];
                $responseredeem = $this->CallApi('/merchant/v1/vouchers/redeem', $postFieldsredeem);
                $statusredeem = $responseredeem->getStatusCode();
                $redeem = json_decode($responseredeem->body());
                if ($statusredeem == 200) {
                    $order->update([
                        'voucher_id' => $redeem->voucher->id,
                        'voucher_amount' => $redeem->voucher->amount,
                        'voucher_currency' => $redeem->voucher->currency,
                        'voucher_createdAt' => $redeem->voucher->createdAt,
                        'voucher_expiryDate' => $redeem->voucher->expiryDate,
                        'voucher_status' => $redeem->voucher->status,
                        'voucher_applicationId' => $redeem->applicationId,
                        'voucher_transactionId' => $redeem->transactionId,
                        'voucher_timestamp' => $redeem->timestamp,
                    ]);
                    $smsa = $this->CallApiSmsa('/addship', $postFieldsSmsa);
                    $awbNo = $smsa;
                    $order->update([
                        'awbNo' => $awbNo,
                        'payment_status' => 'paid',
                    ]);
                    $cart->empty();
                    $OrderItem = OrderItem::whereHas('order', function ($q) use ($order) {
                        $q->where('order_id', $order->id);
                    })->get();
                    foreach ($OrderItem as $items) {
                        $product_s = Products::with('colors')->find($items->product_id);
                        $product_s->update([
                            'quantity' => $product_s->quantity - $items->quantity,
                        ]);
                        $colors = Colors::where('product_id', $items->product_id)->where('color', $items->options)->first();
                        $colors->update([
                            'quantity' => $product_s->quantity - $items->quantity,
                        ]);
                    }
                    Mail::to(Auth::user()->email)->send(new OrderMail($order));
                } else {
                    $order->update([
                        'payment_status' => 'failed',
                    ]);
                    toastr()->error($redeem->message);
                    return redirect()->back();
                }
                // End redeem
                toastr()->success(__('lang.order_done'));
                return redirect('/');
            } else {
                $order->update([
                    'payment_status' => 'failed',
                ]);
                toastr()->error(__('lang.warning'));
                return redirect('/');
            }
        }else{
              toastr()->error(__('lang.warning'));
                return redirect('/');
        }
       
    }

    public function getVoucherDetails(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            // Start getVoucherDetails
            $postFieldsDetails = [
                'voucherCode' => 'XPhscRAVRzhPqKi4',
                'customerId' => '171508197',
                'applicationId' => '1933605',
                // 'voucherCode' => $request->voucherCode,
                // 'customerId' => $request->customerId,
                // 'applicationId' => $request->applicationId,
            ];
            $responseDetails = $this->CallApi('/merchant/v1/vouchers/getVoucherDetails', $postFieldsDetails);
            $statusDetails = $responseDetails->getStatusCode();
            $getVoucherDetails = json_decode($responseDetails->body());
            //cases: REFUNDED CREATED USED
            if ($statusDetails == 200) {
                if ($getVoucherDetails->status == 'CREATED') {
                    if ($getVoucherDetails->amount >= $order->total) {
                        $order->update([
                            'voucherCode' => 'XPhscRAVRzhPqKi4',
                            'customerId' => '1714508197',
                            'applicationId' => '1933605',
                            // 'voucherCode' => $request->voucherCode,
                            // 'customerId' => $request->customerId,
                            // 'applicationId' => $request->applicationId,
                        ]);
                    } else {
                        toastr()->error(__('lang.The_order_cannot_be_divided'));
                        return redirect('/');
                    }
                } else {
                    toastr()->error(__('lang.The_order_cannot_be_divided'));
                    return redirect('/');
                }
            } else {
                toastr()->error($getVoucherDetails->message);
                return redirect('/');
            }
            // End getVoucherDetails

            // Start preRedeem
            $postFieldspreRedeem = [
                'customerId' => '1714508197',
            ];
            $responsepreRedeem = $this->CallApi('/merchant/v1/vouchers/preRedeem', $postFieldspreRedeem);
            $statuspreRedeem = $responsepreRedeem->getStatusCode();
            $preRedeem = json_decode($responsepreRedeem->body());
            if ($statuspreRedeem == 200) {
                $order->update([
                    'otpID_preRedeem' => $preRedeem->otpID,
                ]);
            } else {
                toastr()->error($getVoucherDetails->message);
                return redirect('/');
            }
            // End preRedeem

            // Start redeem
            $postFieldsredeem = [
                'customerId' => '171508197',
                'voucherCode' => 'XPhscRAVRzhPqKi4',
                'transactionId' => '6153ade4-26dd-48be-99cc-332c0914a0b5',
                'otp' => '1234',
                'otpID' => 'd895ca05-6f06-4d9f-954e-8b4a50f43dc3',
            ];
            $responseredeem = $this->CallApi('/merchant/v1/vouchers/redeem', $postFieldsredeem);
            $statusredeem = $responseredeem->getStatusCode();
            $redeem = json_decode($responseredeem->body());
            if ($statusredeem == 200) {
                $order->update([
                    'voucher_id' => $redeem->voucher[0]->id,
                    'voucher_amount' => $redeem->voucher[0]->amount,
                    'voucher_currency' => $redeem->voucher[0]->currency,
                    'voucher_createdAt' => $redeem->voucher[0]->createdAt,
                    'voucher_expiryDate' => $redeem->voucher[0]->expiryDate,
                    'voucher_status' => $redeem->voucher[0]->status,
                    'voucher_applicationId' => $redeem->voucher[0]->applicationId,
                    'voucher_transactionId' => $redeem->voucher[0]->transactionId,
                    'voucher_timestamp' => $redeem->voucher[0]->timestamp,
                ]);
            } else {
                toastr()->error($getVoucherDetails->message);
                return redirect('/');
            }
            // End redeem

            // Start preRefund
            $postFieldspreRefund = [
                'customerId' => '171508197',
            ];
            $responsepreRefund = $this->CallApi('/merchant/v1/vouchers/preRefund', $postFieldspreRefund);
            $statuspreRefund = $responsepreRefund->getStatusCode();
            $preRefund = json_decode($responsepreRefund->body());
            if ($statuspreRefund == 200) {
                $order->update([
                    'otpID_preRedeem' => $preRefund->otpID,
                ]);
            } else {
                toastr()->error($getVoucherDetails->message);
                return redirect('/');
            }
            // End preRefund

            // Start refund
            $postFieldsredeem = [
                'customerId' => '171508197',
                'voucherId' => 'XPhscRAVRzhPqKi4',
                'otp' => '1234',
                'otpID' => 'd895ca05-6f06-4d9f-954e-8b4a50f43dc3',
            ];
            $responserefund = $this->CallApi('/merchant/v1/vouchers/refund', $postFieldsredeem);
            $statusrefund = $responserefund->getStatusCode();
            $refund = json_decode($statusrefund->body());
            if ($statusredeem == 200) {
            } else {
                toastr()->error($getVoucherDetails->message);
                return redirect('/');
            }
            // End refund

        } else {
            toastr()->error(__('lang.warning'));
            return redirect('/');
        }
    }

    public function preRedeem(Request $request)
    {
        $postFields = [
            'customerId' => '2020669475',
        ];
        $response = $this->CallApi('/merchant/v1/vouchers/preRedeem', $postFields);
        dd(json_decode($response->body()));
    }

    public function redeem(Request $request)
    {
        $postFields = [
            'customerId' => '2020669475',
            'voucherCode' => '5wBvO5K69ofL98qN',
            'transactionId' => '6153ade4-26dd-48be-99cc-332c0914a0b5',
            'otp' => '1234',
            'otpID' => 'd895ca05-6f06-4d9f-954e-8b4a50f43dc3',
        ];
        $response = $this->CallApi('/merchant/v1/vouchers/redeem', $postFields);
        dd(json_decode($response->body()));
    }

    public function preRefund(Request $request)
    {
        $postFields = [
            'customerId' => '2020669475',
        ];
        $response = $this->CallApi('/merchant/v1/vouchers/preRefund', $postFields);
        dd(json_decode($response->body()));
    }

    public function refund(Request $request)
    {
        $postFields = [
            'customerId' => '2020669475',
            'voucherId' => '4725',
            'otp' => '1234',
            'otpID' => 'fe4b7569-5bcb-4c99-aca5-09a8d2c3b6f8',
        ];
        $response = $this->CallApi('/merchant/v1/vouchers/refund', $postFields);
        dd(json_decode($response->body()));
    }
    
    public function services_emkan(Request $request)
    {
        return view('web.order.emcan.services_emkan');
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
    public function CallApi($apiUrl, $postFields, $type = 'post')
    {
        // try {
//            $token = 'dUdISVlORjVhbE5jem5rS2VqMk15U3E3WGxVYTpLbG8yblFVMmI5WURIdDA4OVBzSkh1TXIzdThh';
            // $token = 'bUI3Zkk0dzMwcTBGOHdET1VFTXhUMlJ5YWl3YTp0VFFYSEIxS3BiRDVHY3dqa09Od3Y1MkhhdTBh';
            $token = base64_encode('mB7fI4w30q0F8wDOUEMxT2Ryaiwa:tTQXHB1KpbD5GcwjkONwv52Hau0a');

            $headers = [
                'Content-type'  => 'application/json',
                'Authorization' => 'Basic ' . $token,
                'Accept' => 'application/json',
                'LNG' => 'EN',
                'CHN' => 'MERCHANT',
                'MERCHANT_CODE' => 'Shabaka',
            ];
            
            if ($type == 'get') {
                $response = Http::withHeaders($headers)->get('https://b2b.emkanfinance.com.sa' . $apiUrl, $postFields);
                return $response;
            } elseif ($type == 'post') {
                $response = Http::withHeaders($headers)->post('https://b2b.emkanfinance.com.sa' . $apiUrl, $postFields);
                return $response;
            } else {
                abort(403);
            }
        // } catch (Exception $e) {
            // toastr()->error(__('lang.warning'));
            // return redirect('/');
        // }
    }
}
