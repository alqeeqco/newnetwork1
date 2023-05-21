<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsaController extends Controller
{
    public function create (Request $request){
        
        $postFields = [
            'passkey' => 'New@8919',
            'refno' => '10',
            'sentDate' => '2023-02-15',
            'idNo' => '1',
            'cName' => 'Tester',
            'cntry' => 'Saudi Arabia',
            'cCity' => 'Riyadh',
            "cZip" => "1",
            "cPOBox" => "999",
            'cMobile' => '+966 7604 1187604"',
            "cTel1" => "1",
            "cTel2" => "1",
            'cAddr1' => '1931582',
            'cAddr2' => '1931582',
            'shipType' => 'BLT',
            'PCs' => 1,
            'cEmail' => 'alikq109@gmail.com',
            "carrValue" => "1",
            "carrCurr" => "1",
            'codAmt' => 5,
            'weight' => '1',
            'itemDesc' => '1',
            "custVal" => "1",
            "custCurr" => "1",
            "insrAmt" => "1",
            "insrCurr" => "1",
            'sName' => 'test',
            'sContact' => 'KHALED',
            'sAddr1' => '1931582',
            'sAddr2' => '1931582',
            'sCity' => '1931582',
            'sPhone' => '+972594148741',
            'sCntry' => '1',
            "prefDelvDate" => "2023-02-15",
            "gpsPoints" => "1",
        ];
        $response = $this->CallApi('/addship' , $postFields);
        dd(json_decode($response->body()));
    }

    public function CallApi($apiUrl , $postFields , $type = 'post')
    {
        $headers = [
            'Content-type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
        if($type == 'get'){
            $response = Http::withHeaders($headers)->get('https://track.smsaexpress.com/SecomRestWebApi/api'.$apiUrl , $postFields);
            return $response;
        }elseif($type == 'post'){
        $response = Http::withHeaders($headers)->post('https://track.smsaexpress.com/SecomRestWebApi/api'.$apiUrl , $postFields);
        return $response;    
        }else{
            abort(403);
        }
    }
}
