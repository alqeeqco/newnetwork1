<?php

use App\Http\Controllers\API\EmcanPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('createToken' , [EmcanPaymentController::class , 'createToken']);
Route::post('getVoucherDetails' , [EmcanPaymentController::class , 'getVoucherDetails']);
Route::post('preRedeem' , [EmcanPaymentController::class , 'preRedeem']);

