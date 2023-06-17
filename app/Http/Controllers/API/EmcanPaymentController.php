<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class EmcanPaymentController extends Controller
{

    public function getVoucherDetails(Request $request)
    {
        if ($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN') {
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

        return response()->json([
            'massage' => 'تمت العملية بنجاح',
            'status' => true,
            'data' => $getVoucherDetails,
        ], 200);

    }

    public function preRedeem(Request $request)
    {
        if ($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN') {
            return response()->json([
                'massage' => 'لا يمكن أتمام العملية بسبب حدوث خطأ ما',
                'status' => false,
                'data' => null,
            ], 401);
        }
        $postFieldspreRedeem = [
            'customerId' =>  $request->customerId,
        ];
        $responsepreRedeem = $this->CallApi('/merchant/v1/vouchers/preRedeem', $postFieldspreRedeem);
        $statuspreRedeem = $responsepreRedeem->getStatusCode();
        $preRedeem = json_decode($responsepreRedeem->body());

        if ($statuspreRedeem == 200) {
            return response()->json([
                'massage' => 'تمت العملية بنجاح',
                'status' => true,
                'data' => $preRedeem,
            ], 200);
        }
        return response()->json([
            'massage' => $preRedeem->message,
            'status' => false,
            'data' => null,
        ], $statuspreRedeem);
    }

    public function redeem(Request $request)
    {
        if ($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN') {
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

    public function preRefund(Request $request)
    {
        if ($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN') {
            return response()->json([
                'massage' => 'لا يمكن أتمام العملية بسبب حدوث خطأ ما',
                'status' => false,
                'data' => null,
            ], 401);
        }

        $postFieldsRefund = [
            'customerId' => $request->customerId,
        ];

        $responseRefund = $this->CallApi('/merchant/v1/vouchers/preRefund', $postFieldsRefund);
        $statusRefund = $responseRefund->getStatusCode();
        $Refund = json_decode($responseRefund->body());

        if ($statusRefund != 200) {
            return response()->json([
                'massage' => $Refund->message,
                'status' => false,
                'data' => null,
            ], $statusRefund);
        }
        return response()->json([
            'massage' => 'تمت العملية بنحجاح',
            'status' => true,
            'data' => $Refund,
        ], 200);
    }

    public function refund(Request $request){
        if ($request->header('Shabaka-EM-AMEN') != '4tyJG86m5rqaGKBrXkQKwYixqJtNzDfmiwJuupCwg0uzXIaDkaJDoNmjSicw-AMEN' || !$request->total) {
            return response()->json([
                'massage' => 'لا يمكن أتمام العملية بسبب حدوث خطأ ما',
                'status' => false,
                'data' => null,
            ], 401);
        }
        $postFieldspreRedeem = [
            'customerId' => $request->customerId,
            'voucherId' =>  $request->voucherId,
            'otp' =>  $request->otp,
            'otpID' =>  $request->otpID,
        ];
        $responsepreRedeem = $this->CallApi('/merchant/v1/vouchers/refund', $postFieldspreRedeem);
        $statuspreRedeem = $responsepreRedeem->getStatusCode();
        $preRedeem = json_decode($responsepreRedeem->body());

        if ($statuspreRedeem == 200) {
            return response()->json([
                'massage' => 'تمت العملية بنجاح',
                'status' => true,
                'data' => $preRedeem,
            ], 200);
        }
        return response()->json([
            'massage' => $preRedeem->message,
            'status' => false,
            'data' => null,
        ], $statuspreRedeem);
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
