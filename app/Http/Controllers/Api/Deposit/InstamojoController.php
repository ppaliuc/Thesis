<?php

namespace App\Http\Controllers\Api\Deposit;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use Illuminate\Http\Request;
use App\Classes\Instamojo;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;

class InstamojoController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $gs = Generalsetting::first();

        $data = PaymentGateway::whereKeyword('instamojo')->first();
        $paydata = $data->convertAutoData();
        $total =  $request->amount;

        if($request->currency_code != "INR")
        {
            $data['get'] = json_encode(['status' => false, 'data' => "Please Select INR Currency For Instamojo", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $deposit = Deposit::findOrFail($request->deposit_id);
        
        if($deposit->method != NULL){
            $data['get'] = json_encode(['status' => false, 'data' => "Payment already completed", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $user = User::findOrFail($deposit->user_id);
        $order['item_name'] = $gs->title." Deposit";
        $order['item_number'] = $deposit->deposit_number;
        $order['item_amount'] = $total;

        $cancel_url = route('api.deposit.paypal.cancel');
        $notify_url = route('api.deposit.instamojo.notify');

        if($paydata['sandbox_check'] == 1){
            $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        }
        else {
            $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $order['item_name'],
                "amount" => $order['item_amount'],
                "send_email" => true,
                "email" => $user->email,
                "redirect_url" => $notify_url
        ));
        $redirect_url = $response['longurl'];

        Session::put('method',$request->method);
        Session::put('deposit_id',$request->deposit_id);

        Session::put('order_payment_id', $response['id']);

        return redirect($redirect_url);

        }
        catch (Exception $e) {
            return redirect($cancel_url)->with('unsuccess','Error: ' . $e->getMessage());
        }
    }


    public function notify(Request $request)
    {
        $method = Session::get('method');
        $deposit_id = Session::get('deposit_id');

        $deposit = Deposit::findOrFail($deposit_id);

        $input_data = $request->all();
        $user = User::findOrFail($deposit->user_id);


        $payment_id = Session::get('order_payment_id');
        if($input_data['payment_status'] == 'Failed'){
            $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        if ($input_data['payment_request_id'] == $payment_id) {

            $deposit['method'] = $method;
            $deposit['txnid'] = $payment_id;
            $deposit['status'] = "complete";

            $deposit->save();


            $gs =  Generalsetting::findOrFail(1);

            $user = auth()->user();
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
            $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
            return view('frontend.api_payment',$data);
    }
}
