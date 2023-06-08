<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Repositories\SubscriptionRepository;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Http\Request;
use Session;
use Str;

class MollieController extends Controller
{
    private $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
    {
        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request){
        $support = [
            'AED',
            'AUD',
            'BGN',
            'BRL',
            'CAD',
            'CHF',
            'CZK',
            'DKK',
            'EUR',
            'GBP',
            'HKD',
            'HRK',
            'HUF',
            'ILS',
            'ISK',
            'JPY',
            'MXN',
            'MYR',
            'NOK',
            'NZD',
            'PHP',
            'PLN',
            'RON',
            'RUB',
            'SEK',
            'SGD',
            'THB',
            'TWD',
            'USD',
            'ZAR'
        ];
        
        if(!in_array($request->currency_code,$support)){
            $data['get'] = json_encode(['status' => false, 'data' => "Please Select other currency For mollie", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $item_amount = $request->price;
        $input = $request->all();

        $item_name = "Deposit via Molly Payment";

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $request->currency_code,
                'value' => ''.sprintf('%0.2f', $item_amount).'',
            ],
            'description' => $item_name ,
            'redirectUrl' => route('subscription.molly.notify'),
            ]);


        Session::put('input_data',$input);
        Session::put('payment_id',$payment->id);
        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function notify(Request $request){

        $input = Session::get('input_data');
        $item_number = Str::random(4).time();


        $payment = Mollie::api()->payments()->get(Session::get('payment_id'));

        if($payment->status == 'paid'){
            $addionalData = ['subscription_number'=>$item_number];
            $this->subscriptionRepositorty->OrderFromSession($request,'completed',$addionalData);

            Session::forget('molly_data');
            
            $data['get'] = json_encode(['status' => true, 'data' => "Bank plan updated successfully", 'error' => []]);
            return view('frontend.api_payment',$data);
        }
        else {
            $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
            return view('frontend.api_payment',$data);
        }

        $data['get'] = json_encode(['status' => false, 'data' => "Something went wrong!", 'error' => []]);
        return view('frontend.api_payment',$data);
    }
}
