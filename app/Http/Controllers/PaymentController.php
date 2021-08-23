<?php

namespace App\Http\Controllers;

use App\CoursePurchase;
use App\PendingEnrollment;
use GuzzleHttp\Client;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

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
        $name = explode(' ', $enrollment->user->name);
        $firstName = $name[0];
        $lastName = $name[count($name) - 1];
        $query = ['auth_token' => $authToken,
            'amount_cents' => $data->amount_cents,
            'expiration' => 3600,
            'order_id' => $data->id,
            'billing_data' => [
                "apartment"=> "NA",
                "email"=> $enrollment->user->email,
                "floor"=> "NA",
                "first_name"=> $firstName,
                "street"=> "NA",
                "building"=> "NA",
                "phone_number"=> $enrollment->user->phone,
                "shipping_method"=> "PKG",
                "postal_code"=> "NA",
                "city"=> "NA",
                "country"=> "NA",
                "last_name"=> $lastName,
                "state"=> "NA"
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
        $enrollment = PendingEnrollment::where('payment_id', $request['obj']['id'])->firstOrFail();
        if($request['obj']['success'] == "true"){
            $user = $enrollment->user;

            //create payment and purchase.
            $veedrosPayment = \App\Payment::createPayment($enrollment, 'accept');


            $veedrosPayment->createPurchases($enrollment);

            //Enroll user
            EnrollController::enrollInMultipleCourses($user,$enrollment);

            //send email notifications to user, admins, and instructors
            $veedrosPayment->notifyUser();

//            $veedrosPayment->notifyInstructors();

            $veedrosPayment->notifyAdmins();
        }
    }

    public function showToken() {
        echo csrf_token();
    }

    public function paypalCreatePayment($user_id, $code){
        $user = \App\User::where('id', $user_id)->firstOrFail();
        $total = CartController::calculateTotal($code, $user)['total'];

        $enrollment = PendingEnrollment::create([
            'user_id'=> $user->id,
            'merchant_order_id' => PendingEnrollment::generateMerchantOrderId(),
            'subtotal' => $total
        ]);

        $enrollment->courses()->sync($user->carted);

        $enrollment->addPromoCode($code);


        $apiContext = new ApiContext(
          new OAuthTokenCredential(
              env('PAYPAL_SANDBOX_API_ID'),
              env('PAYPAL_SANDBOX_API_SECRET')
          )
        );


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(PaymentController::convertCurrency($enrollment->subtotal, 'EGP', 'USD'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setInvoiceNumber(uniqid());

        $baseUrl = URL::to('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/cart/checkout")
            ->setCancelUrl("$baseUrl/cart/checkout");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;
        try {
            $payment->create($apiContext);
            $payment->enrollment_id = $enrollment->id;
        } catch (\Exception $ex) {
            exit(1);
        }
        $approvalUrl = $payment->getApprovalLink();
        return $payment;

    }

    public function paypalExecutePayment(Request $request){
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_SANDBOX_API_ID'),
                env('PAYPAL_SANDBOX_API_SECRET')
            )
        );


        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);

        try {
            $result = $payment->execute($execution, $apiContext);
        } catch (\Exception $ex) {
            exit(1);
        }


        if($result->state == 'approved'){
            $enrollment = PendingEnrollment::where('id', $request->enrollmentID)->firstOrFail();
            $user = $enrollment->user;

            //create payment and purchase.
            $veedrosPayment = \App\Payment::createPayment($enrollment, 'paypal');


            CoursePurchase::createPurchases($veedrosPayment, $enrollment);

            //Enroll user
            EnrollController::enrollInMultipleCourses($user,$enrollment);

            //send email notifications to user, admins, and instructors
            $veedrosPayment->notifyUser();

//            $veedrosPayment->notifyInstructors();

            $veedrosPayment->notifyAdmins();
        }

        return $result;
    }

    public static function convertCurrency($amount,$from_currency,$to_currency){
        $apikey = env('CURRENCY_CONVERTER_API_KEY');

        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query =  "{$from_Currency}_{$to_Currency}";

        // change to the free URL if you're using the free version
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);

        $val = floatval($obj["$query"]);


        $total = $val * $amount;
        return number_format($total, 2, '.', '');
    }

    public static function getEGPtoUSD(){
        $apikey = env('CURRENCY_CONVERTER_API_KEY');

        $query =  "EGP_USD";

        // change to the free URL if you're using the free version
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);

        return floatval($obj["$query"]);

    }
}
