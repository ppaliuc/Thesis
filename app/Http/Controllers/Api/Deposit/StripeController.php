<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Classes\GeniusMailer;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Config;

class StripeController extends Controller
{
    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('Stripe')->first();
        $paydata = $data->convertAutoData();

        Config::set('services.stripe.key', $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);
    }

    public function store(Request $request){

        $deposit = Deposit::findOrFail($request->deposit_id);

        if($deposit->method != NULL){
            $data['get'] = json_encode(['status' => false, 'data' => "Please Select USD Or EUR Currency For Stripe", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $gs =  Generalsetting::findOrFail(1);
        $item_name = $gs->title." Deposit";
        $item_amount = $request->amount;

        $support = ['USD'];
        if(!in_array($request->currency_code,$support)){
            $data['get'] = 0;
            return view('frontend.api_payment',$data);
        }

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    $data['get'] = 0;
                    return view('frontend.api_payment',$data);
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $request->currency_code,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $deposit->method = $request->method;
                    $deposit->txnid = $charge['balance_transaction'];
                    $deposit->charge_id = $charge['id'];
                    $deposit->status = 'complete';
                    $deposit->update();

                    $user = User::findOrFail($deposit->user_id);
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
                            'oamount' => $item_amount,
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

                    $data['get'] = json_encode(['status' => true, 'data' => "Bank plan updated successfully", 'error' => []]);
                    return view('frontend.api_payment',$data);
                }

            }catch (Exception $e){
                $data['get'] = json_encode(['status' => false, 'data' => $e->getMessage(), 'error' => []]);
                return view('frontend.api_payment',$data);
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                $data['get'] = json_encode(['status' => false, 'data' => $e->getMessage(), 'error' => []]);
                return view('frontend.api_payment',$data);
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                $data['get'] = json_encode(['status' => false, 'data' => $e->getMessage(), 'error' => []]);
                return view('frontend.api_payment',$data);
            }
        }
        $data['get'] = json_encode(['status' => false, 'data' => 'Please Enter Valid Credit Card Informations.', 'error' => []]);
        return view('frontend.api_payment',$data);
    }
}
