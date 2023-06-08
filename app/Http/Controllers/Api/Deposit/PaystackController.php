<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;

class PaystackController extends Controller
{
    public function store(Request $request){
        $gs =  Generalsetting::findOrFail(1);

        if($request->currency_code != "NGN")
        {
            $data['get'] = json_encode(['status' => false, 'data' => "Please Select NGN Currency For Paystack", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $deposit = Deposit::findOrFail($request->deposit_id);
        if($deposit->method != NULL){
            $data['get'] = json_encode(['status' => false, 'data' => "Payment already completed", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $deposit->method = $request->method;
        $deposit->txnid = $request->paystack_txn;
        $deposit['status'] = "complete";
        $deposit->update();

        $user = User::findOrFail($deposit->user_id);
        $user->income += $deposit->amount;
        $user->save();

        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $user->email,
                'type' => "Deposit",
                'cname' => $user->name,
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
}
