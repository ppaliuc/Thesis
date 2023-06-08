<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FlutterwaveController extends Controller
{
    public $public_key;
    private $secret_key;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $paydata = $data->convertAutoData();
        $this->public_key = $paydata['public_key'];
        $this->secret_key = $paydata['secret_key'];
    }

    public function store(Request $request) {
        $curl = curl_init();

        $deposit = Deposit::findOrFail($request->deposit_id);
        if($deposit->method != NULL){
            $data['get'] = json_encode(['status' => false, 'data' => "Payment already completed", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $user = User::findOrFail($deposit->user_id);

        $customer_email =  $user->email;
        $currency = $request->currency_code;
        $PBFPubKey = $this->public_key;
        $redirect_url = route('api.deposit.flutter.notify');
        $payment_plan = "";

        $settings = Generalsetting::first();
        $item_name = $settings->title." Deposit";
        $item_number = $deposit->deposit_number;
        $txref = $item_number;
        $item_amount = $request->amount;

        Session::put('method',$request->method);
        Session::put('deposit_id',$request->deposit_id);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
              'amount' => $item_amount,
              'customer_email' => $customer_email,
              'currency' => $currency,
              'txref' => $txref,
              'PBFPubKey' => $PBFPubKey,
              'redirect_url' => $redirect_url,
              'payment_plan' => $payment_plan
            ]),
            CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
            ],
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          if($err){
            die('Curl returned error: ' . $err);
          }

          $transaction = json_decode($response);

          if(!$transaction->data && !$transaction->data->link){
            print_r('API returned error: ' . $transaction->message);
          }

          return redirect($transaction->data->link);

     }

     public function notify(Request $request) {

        $input = $request->all();
        $method = Session::get('method');
        $deposit_id = Session::get('deposit_id');
        $deposit = Deposit::findOrFail($deposit_id);

        $user = User::findOrFail($deposit->user_id);

        if($request->cancelled == "true"){
            $data['get'] = 0;
            return view('frontend.api_payment',$data);
        }


        if (isset($input['txref'])) {
            $ref = $input['txref'];
            $query = array(
                "SECKEY" => $this->secret_key,
                "txref" => $ref
            );

            $data_string = json_encode($query);

            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);
            curl_close($ch);
            $resp = json_decode($response, true);

            if ($resp['status'] == "success") {

              $paymentStatus = $resp['data']['status'];
              $chargeResponsecode = $resp['data']['chargecode'];

              if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($paymentStatus == "successful")) {

                  $order['txnid'] = $resp['data']['txid'];
                  $data['status'] = "complete";
                  $deposit->update($data);

                  $gs =  Generalsetting::findOrFail(1);

                  $user->balance += $deposit->amount;
                  $user->save();

                  $trans = new Transaction();
                  $trans->email = $user->email;
                  $trans->amount = $deposit->amount;
                  $trans->type = "Deposit";
                  $trans->profit = "plus";
                  $trans->txnid = $deposit->deposit_number;
                  $trans->user_id = $user->id;
                  $trans->save();

                  if($gs->is_smtp == 1)
                  {
                      $data = [
                          'to' => $user->email,
                          'type' => "Deposit",
                          'cname' => $user->name,
                          'oamount' => $deposit->amount,
                          'aname' => "",
                          'aemail' => "",
                          'wtitle' => "",
                      ];

                      $mailer = new GeniusMailer();
                      $mailer->sendAutoMail($data);
                  }
                  else
                  {
                    $to = $user->email;
                    $subject = " You have deposited successfully.";
                    $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);
                  }

                $data['get'] = json_encode(['status' => true, 'data' => "Deposit completed successfully", 'error' => []]);
                return view('frontend.api_payment',$data);

              }
              else {
                    $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
                    return view('frontend.api_payment',$data);
              }

            }
        }
        else {
            $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

    }
}
