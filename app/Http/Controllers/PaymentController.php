<?php

namespace App\Http\Controllers;

use App\PendingEnrollment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public $authToken;

    public function init(){
        $query = ['api_key' => env('WEACCEPT_KEY')];
        $query = json_encode($query);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $res = $client->post('https://accept.paymobsolutions.com/api/auth/tokens',
            ['body' => $query]);
        return json_decode($res->getBody());
    }

    public function registerRequest(){
        $data = $this->init();
        $enrollment = \App\PendingEnrollment::all()->random();
        $this->authToken = $data->token;
        $query =
            ['auth_token' => $data->token,
            'delivery_needed' => false,
            'merchant_id'=> $data->profile->id,
            'amount_cents' => intval($enrollment->course->price) * 100,
            'currency' => 'EGP',
            'merchant_order_id' => $enrollment->merchant_order_id,
            'items' => []];
        $query = json_encode($query);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $res = $client->post('https://accept.paymobsolutions.com/api/ecommerce/orders',
            ['body' => $query]);
        return json_decode($res->getBody());
    }

    public function keyRequest()
    {
        $data = $this->registerRequest();
        $query = ['auth_token' => $this->authToken,
            'amount_cents' => $data->amount_cents,
            'expiration' => 3600,
            'order_id' => $data->id,
            'billing_data' => [
                "apartment"=> "8503",
                "email"=> "clau5dette09@exa.com",
                "floor"=> "452",
                "first_name"=> "Clif5ford",
                "street"=> "Ethan L5and",
                "building"=> "80528",
                "phone_number"=> "+865(8)9135210487",
                "shipping_method"=> "P5KG",
                "postal_code"=> "018598",
                "city"=> "Jaskolski5burgh",
                "country"=> "C5R",
                "last_name"=> "Ni5colas",
                "state"=> "Ut5ah"
            ] ,
            'currency' => 'EGP',
            'integration_id' => 23294];
        $query = json_encode($query);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $res = $client->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys',
            ['body' => $query]);
        return json_decode($res->getBody());
    }

    public function payRequest(){
        $token = $this->keyRequest()->token;
        $query = [
            'source' => [
                'identifier' => 'AGGREGATOR',
                'subtype' => 'AGGREGATOR',
                ],
            'payment_token' => $token];
        $query = json_encode($query);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $res = $client->post('https://accept.paymobsolutions.com/api/acceptance/payments/pay',
            ['body' => $query]);
        $res = json_decode($res->getBody());

        $enrollment = PendingEnrollment::where('merchant_order_id', $res->order->merchant_order_id)->firstOrFail();
        $enrollment->payment_id = $res->id;
        $enrollment->save();
        Log::info("Received callback", [$res]);

    }

    public function weacceptCallback(Request $request){
        Log::info("Received callback", $request->all());
        $enrollment = PendingEnrollment::where('payment_id', $request['obj']['id'])->firstOrFail();
        if($request['obj']['success'] == true){
            $user = $enrollment->user();
            $course = $enrollment->course();
            EnrollController::enrollUser($user,$course);
        }
    }

    public function showToken() {
        echo csrf_token();
    }
}
