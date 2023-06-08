<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\Generalsetting;
use App\Models\User;

class ManualController extends Controller
{
    public function store(Request $request){
        $deposit = Deposit::findOrFail($request->deposit_id);
        
        if($deposit->method != NULL){
            $data['get'] = json_encode(['status' => false, 'data' => "Payment already completed", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $deposit->method = $request->method;
        $deposit->txnid = $request->txn_id4;
        $deposit->status = 'pending';
        $deposit->update();

        $gs =  Generalsetting::findOrFail(1);
        $user = User::findOrFail($deposit->user_id);

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
           $msg = "Hello ".$user->name."!\nYou have deposited successfully.\nThank you.";
           $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }

        $data['get'] = json_encode(['status' => true, 'data' => "Deposit completed successfully", 'error' => []]);
        return view('frontend.api_payment',$data);
    }
}
