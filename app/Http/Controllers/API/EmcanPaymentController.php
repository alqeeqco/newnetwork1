<?php

namespace App\Http\Controllers\API;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class EmcanPaymentController extends Controller
{
    public function store(Request $request, $id)
    {
        $postFieldsDetails = [
            'voucherCode' => $request->voucherCode,
            'customerId' => $request->customerId,
            'applicationId' => $request->applicationId,
        ];
        $responseDetails = $this->CallApi('/merchant/v1/vouchers/getVoucherDetails', $postFieldsDetails);
        $statusDetails = $responseDetails->getStatusCode();
        $getVoucherDetails = json_decode($responseDetails);
        if ($statusDetails == 200) {
            if ($getVoucherDetails->status == 'CREATED') {
                if ($getVoucherDetails->amount >= $request->total) {
                    $dataVoucherDetails = [
                        'voucherCode' => $request->voucherCode,
                        'customerId' => $request->customerId,
                        'applicationId' => $request->applicationId,
                    ];
                } else {
                    $dataVoucherDetails = [];
                }
            } else {
                $dataVoucherDetails = [];
            }
        } else {
            $dataVoucherDetails = [];
        }
        // End getVoucherDetails

        // Start preRedeem
        $postFieldspreRedeem = [
            'customerId' =>  $dataVoucherDetails['customerId'],
        ];
        $responsepreRedeem = $this->CallApi('/merchant/v1/vouchers/preRedeem', $postFieldspreRedeem);
        $statuspreRedeem = $responsepreRedeem->getStatusCode();
        $preRedeem = json_decode($responsepreRedeem->body());

        if ($statuspreRedeem == 200) {
            $dataPreRedeem = [
                'otpID_preRedeem' => $preRedeem->otpID,
            ];
        } else {
            $dataPreRedeem = [];
        }
        // End preRedeem
    }

    public function otp(Request $request, CartRepository $cart, $id)
    {
        $postFieldsredeem = [
            'customerId' => $request->customerId,
            'voucherCode' => $request->voucherCode,
            'transactionId' => 'Shabaka-' . $request->id,
            'otp' => $request->otp,
            'otpID' => $request->otpID_preRedeem,
        ];
        $responseredeem = $this->CallApi('/merchant/v1/vouchers/redeem', $postFieldsredeem);
        $statusredeem = $responseredeem->getStatusCode();
        $redeem = json_decode($responseredeem->body());
        if ($statusredeem == 200) {
            return $redeem;
        } else {

        }
    }

    public function CallApi($apiUrl, $postFields, $type = 'post')
    {
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
    }
}
