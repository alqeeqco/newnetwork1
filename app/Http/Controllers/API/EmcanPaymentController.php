<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class EmcanPaymentController extends Controller
{

    // public function createToken()
    // {

    //     return response()->json([
    //         'massage' => 'تم أنشاء توكن بنجاح',
    //         'status' => true,
    //         'token' => Str::random(60)
    //     ], 200);
    // }

    public function getVoucherDetails(Request $request)
    {
        if($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN' || !$request->total){
            return response()->json([
                'massage' => 'لا يمكن أتمام العملية بسبب حدوث خطأ ما',
                'status' => false,
                'data' => null,
            ], 401);
        }
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
                'status' => false,
                'massage' => $getVoucherDetails->message,
                'data' => null,
            ], $statusDetails);
        }
        if ($getVoucherDetails->status != 'CREATED') {
            return response()->json([
                'massage' => 'CREATED' . ' لا يمكن اتمام الطلب لان حالة القسمية ليست',
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

    public function preRedeem(Request $request)
    {
        if($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN'){
            return response()->json([
                'massage' => 'لا يمكن أتمام العملية بسبب حدوث خطأ ما',
                'status' => false,
                'data' => null,
            ], 401);
        }

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
        $amen = '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN';

        $token = base64_encode('mB7fI4w30q0F8wDOUEMxT2Ryaiwa:tTQXHB1KpbD5GcwjkONwv52Hau0a');

        $headers = [
            'Content-type'  => 'application/json',
            'Authorization' => 'Basic ' . $token,
            'Accept' => 'application/json',
            'LNG' => 'AR',
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
