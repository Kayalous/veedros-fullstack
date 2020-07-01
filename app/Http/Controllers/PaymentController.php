<?php

namespace App\Http\Controllers;

use App\PendingEnrollment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public static function init(){
        $query = ['api_key' => env('WEACCEPT_KEY')];
        $query = json_encode($query);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $res = $client->post('https://accept.paymobsolutions.com/api/auth/tokens',
            ['body' => $query]);
        return json_decode($res->getBody());
    }

    public static function registerRequest(PendingEnrollment $enrollment){
        $data = PaymentController::init();
        $authToken = $data->token;
        $query =
            ['auth_token' => $data->token,
            'delivery_needed' => false,
            'merchant_id'=> $data->profile->id,
            'amount_cents' => intval($enrollment->subtotal) * 100,
            'currency' => 'EGP',
            'merchant_order_id' => $enrollment->merchant_order_id,
            'items' => []];
        $query = json_encode($query);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        $res = $client->post('https://accept.paymobsolutions.com/api/ecommerce/orders',
            ['body' => $query]);
        return ['data'=>json_decode($res->getBody()),
            'authToken' => $authToken];
    }

    public static function keyRequest(PendingEnrollment $enrollment)
    {
        $registeredRequest = PaymentController::registerRequest($enrollment);
        $authToken = $registeredRequest['authToken'];
        $data = $registeredRequest['data'];
        $query = ['auth_token' => $authToken,
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

    public static function payRequest(PendingEnrollment $enrollment){
        $token = PaymentController::keyRequest($enrollment)->token;
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
        return $res->data->bill_reference;
    }

    public function weacceptCallback(Request $request){
        Log::info("Received callback", $request->all());
        $enrollment = PendingEnrollment::where('payment_id', $request['obj']['id'])->firstOrFail();
        if($request['obj']['success'] == "true"){
            $user = $enrollment->user;
            $course = $enrollment->course;
            EnrollController::enrollUser($user,$course);
            //send email notification to user

            //send email notification to Admin
        }
    }

    public function showToken() {
        echo csrf_token();
    }
}
