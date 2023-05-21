<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TamaraController extends Controller
{
    public function index()
    {
        $apiURL = "https://api-sandbox.tamara.co";
        $apiKey = "test";

        $postFields = [
            'order_reference_id' => '123456',
//            'order_number' => 'A123456',
            'total_amount' => [
                'amount' => 100.00,
                'currency' => 'SAR',
            ],
            'description' => 'description',
            'country_code' => 'SA',
            'payment_type' => 'PAY_BY_INSTALMENTS',
//            'instalments' => null,
//            'locale' => 'en_US',
            'items' => [
                    "reference_id" => "123456",
                    "type" => "Digital",
                    "name" => "Lego City 8601",
                    "sku" => "SA-12436",
                    "image_url" => "https://www.example.com/product.jpg",
                    "quantity" => 10,
                    "unit_price" => [
                    "amount" => "100.00",
                    "currency" => "SAR"
                    ],
                    "discount_amount" => [
                    "amount" => "100.00",
                    "currency" => "SAR"
                    ],
                    "tax_amount" => [
                    "amount" => "100.00",
                    "currency" => "SAR"
                    ],
                    "total_amount" => [
                    "amount" => "100.00",
                    "currency" => "SAR"
                    ]
            ],
            "consumer" => [
                "first_name" => "Mona",
                "last_name" => "Lisa",
                "phone_number" => "502223333",
                "email" => "user@example.com"
            ],
//            "billing_address" => [
//                "first_name" => "Mona",
//                "last_name" => "Lisa",
//                "line1" => "3764 Al Urubah Rd",
//                "line2" => "string",
//                "region" => "As Sulimaniyah",
//                "postal_code" => "12345",
//                "city" => "Riyadh",
//                "country_code" => "SA",
//                "phone_number" => "502223333"
//            ],
            "shipping_address" => [
                "first_name" => "Mona",
                "last_name" => "Lisa",
                "line1" => "3764 Al Urubah Rd",
                "line2" => "string",
                "region" => "As Sulimaniyah",
                "postal_code" => "12345",
                "city" => "Riyadh",
                "country_code" => "SA",
                "phone_number" => "502223333"
            ],
            "tax_amount" => [
                "amount" => "100.00",
                "currency" => "SAR"
            ],
            "shipping_amount" => [
            "amount" => "100.00",
            "currency" => "SAR"
            ],
            "merchant_url" => [
                "success"=> "https://example.com/checkout/success",
                "failure"=> "https://example.com/checkout/failure",
                "cancel"=> "https://example.com/checkout/cancel",
                "notification"=> "https://example.com/payments/tamarapay"
            ],
//            'platform' => 'Magento',
//            'is_mobile' => false,
        ];
        // $headers = [
        //     'Content-type'  => 'application/json',
        //     'Accept'        => 'application/json',
        //     'Authorization' => 'Basic NHJxZjZSTlBuUWhlMHl3VWF6a1NXRXdSWjlRYTpRUm1NVEtLZUFtM2R0Z0l2bGxLbHNPTGVsazBh',
        // ];
        // $response = Http::withHeaders($headers)->post('https://api-sandbox.tamara.co/checkout' , $postFields);
        // dd(json_decode($response->body()));
        // $data = $this->executePayment($apiURL , $apiKey , $postFields);
        // return $data;
    }

    function executePayment($apiURL, $apiKey, $postFields)
    {
        $json = $this->callAPI("$apiURL/checkout", $apiKey, $postFields , 'POST');
        return $json;
    }

    function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {
        $curl = curl_init($endpointURL);

        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_POSTFIELDS => json_encode($postFields),
            CURLOPT_HTTPHEADER => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
//            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);

        }
    }

}
