<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmcanPaymentController extends Controller
{
    public function store(Request $request)
    {
        $postFieldsDetails = [
            'voucherCode' => $request->voucherCode,
            'customerId' => $request->customerId,
            'applicationId' => $request->applicationId,
        ];
        $responseDetails = $this->CallApi('/merchant/v1/vouchers/getVoucherDetails', $postFieldsDetails);
        $statusDetails = $responseDetails->getStatusCode();
        $getVoucherDetails = json_decode($responseDetails);
        if ($statusDetails != 200) {
            return response()->json([
                'massage' => $getVoucherDetails->message,
                'status' => false,
                'data' => null,
            ], $statusDetails);
        }
        if ($getVoucherDetails->status != 'CREATED') {
            return response()->json([
                'massage' => 'CREATED' . 'لا يمكن اتمام الطلب لان حالة القسمية ليست ',
                'status' => false,
                'data' => null,
            ], 200);
        }
        if ($getVoucherDetails->amount >= $request->total) {
            $dataVoucherDetails = [
                'voucherCode' => $request->voucherCode,
                'customerId' => $request->customerId,
                'applicationId' => $request->applicationId,
            ];
        } else {
            return response()->json([
                'massage' => 'لا يمكن اتمام الطلب لان مجموع الطلب أكثر من مجموع القسمية',
                'status' => false,
                'data' => null,
            ], 200);
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
            $data = array_merge($dataPreRedeem, $dataVoucherDetails);
            return response()->json([
                'massage' => 'تمت العملية بنجاح',
                'status' => true,
                'data' => $data,
            ], 200);
        }
        return response()->json([
            'massage' => $preRedeem->message,
            'status' => false,
            'data' => null,
        ], $statuspreRedeem);
        // End preRedeem
    }

    public function otp(Request $request)
    {
        $postFieldsredeem = [
            'customerId' => $request->customerId,
            'voucherCode' => $request->voucherCode,
            'transactionId' => 'Shabaka-' . $request->transactionId,
            'otp' => $request->otp,
            'otpID' => $request->otpID,
        ];

        $responseredeem = $this->CallApi('/merchant/v1/vouchers/redeem', $postFieldsredeem);
        $statusredeem = $responseredeem->getStatusCode();
        $redeem = json_decode($responseredeem->body());
        if ($statusredeem == 200) {
            return response()->json([
                'massage' => 'تمت العملية بنجاح',
                'status' => true,
                'data' => $redeem,
            ], 200);
        }

        return response()->json([
            'massage' => $redeem->message,
            'status' => false,
            'data' => null,
        ], $statusredeem);
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
