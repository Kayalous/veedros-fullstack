<?php

use App\VideosToTranscode;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/transcoding-backlog', function (){
    $backlog = VideosToTranscode::where('transcoded_at', null)->get()->toJson();
    return $backlog;
});

Route::get('/mark/transcoded/{session_id}', function ($session_id){
    VideosToTranscode::markAsTranscoded($session_id);
});

Route::post('/paypal/create-payment/{user_id}/{promo_code}', 'PaymentController@paypalCreatePayment');
Route::post('/paypal/execute-payment', 'PaymentController@paypalExecutePayment');


