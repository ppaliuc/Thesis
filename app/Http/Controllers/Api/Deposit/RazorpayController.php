<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('razorpay')->first();
        $paydata = $data->convertAutoData();
        $this->keyId = $paydata['key'];
        $this->keySecret = $paydata['secret'];
        $this->displayCurrency = 'INR';
        $this->api = new Api($this->keyId, $this->keySecret);
    }

    public function store(Request $request)
    {
        if($request->currency_code != "INR")
        {
            $data['get'] = json_encode(['status' => false, 'data' => "Please Select INR Currency For razorpay", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $gs = Generalsetting::findOrFail(1);
        $deposit = Deposit::findOrFail($request->deposit_id);
        
        if($deposit->method != NULL){
            $data['get'] = json_encode(['status' => false, 'data' => "Payment already completed", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $input = $request->all();
        $item_name = $gs->title." Deposit";
        $item_number = $deposit->deposit_number;
        $item_amount = $request->amount;

        $order['item_name'] = $item_name;
        $order['item_number'] = $item_number;
        $order['item_amount'] = round($item_amount,2);

        $cancel_url = route('api.subscription.razorpay.cancel',$deposit->id);
        $notify_url = route('api.deposit.razorpay.notify');


        $orderData = [
            'receipt'         => $order['item_number'],
            'amount'          => $order['item_amount'] * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $this->api->order->create($orderData);

        // $input['user_id'] = auth()->user()->id;

        Session::put('input_data',$input);
        Session::put('order_data',$order);
        Session::put('order_payment_id', $razorpayOrder['id']);

        $displayAmount = $amount = $orderData['amount'];

        if ($this->displayCurrency !== 'INR')
        {
            $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
        }

        $checkout = 'automatic';

        if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
        {
            $checkout = $_GET['checkout'];
        }

        $data = [
            "key"               => $this->keyId,
            "amount"            => $amount,
            "name"              => $order['item_name'],
            "description"       => $order['item_name'],
            "prefill"           => [
                "name"              => $request->customer_name,
                "email"             => $request->customer_email,
                "contact"           => $request->customer_phone,
            ],
            "notes"             => [
                "address"           => $request->customer_address,
                "merchant_order_id" => $order['item_number'],
            ],
            "theme"             => [
                "color"             => "{{$gs->colors}}"
            ],
            "order_id"          => $razorpayOrder['id'],
        ];

        if ($this->displayCurrency !== 'INR')
        {
            $data['display_currency']  = $this->displayCurrency;
            $data['display_amount']    = $displayAmount;
        }

        $json = json_encode($data);
        $displayCurrency = $this->displayCurrency;

        Session::put('method',$request->method);
        Session::put('deposit_id',$request->deposit_id);

        return view( 'frontend.razorpay-checkout', compact( 'data','displayCurrency','json','notify_url' ) );
    }

    public function notify(Request $request)
    {
        $input = Session::get('input_data');
        $order_data = Session::get('order_data');
        $input_data = $request->all();

        $payment_id = Session::get('order_payment_id');

        $method = Session::get('method');
        $deposit_id = Session::get('deposit_id');

        $deposit = Deposit::findOrFail($deposit_id);

        $success = true;

        if (empty($input_data['razorpay_payment_id']) === false)
        {
            try
            {
                $attributes = array(
                    'razorpay_order_id' => $payment_id,
                    'razorpay_payment_id' => $input_data['razorpay_payment_id'],
                    'razorpay_signature' => $input_data['razorpay_signature']
                );

                $this->api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
            }
        }

        if ($success === true){
            $deposit['method'] = $method;
            $deposit['txnid'] = $payment_id;
            $deposit['status'] = "complete";
            $deposit->update();

            $gs =  Generalsetting::findOrFail(1);

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
                    'oamount' => $input['amount'],
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

    public function cancel($id){
            $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
            return view('frontend.api_payment',$data);
    }
}
