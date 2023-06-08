<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Repositories\SubscriptionRepository;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StripeController extends Controller
{
    public $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
    {
        $data = PaymentGateway::whereKeyword('Stripe')->first();
        $paydata = $data->convertAutoData();

        Config::set('services.stripe.key', $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);

        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request){
        $settings = Generalsetting::findOrFail(1);
        $item_name = $settings->title." Subscription";

        $item_amount = $request->price;
        $item_number = Str::random(4).time();

        $support = ['USD'];
        if(!in_array($request->currency_code,$support)){

            $data['get'] = json_encode(['status' => false, 'data' => "Please Select USD Or EUR Currency For Stripe", 'error' => []]);
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
                    $addionalData = ['subscription_number'=>$item_number,'txnid'=>$charge['balance_transaction']];
                    $this->subscriptionRepositorty->order($request,'completed',$addionalData);

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
        $data['get'] = 0;
        return view('frontend.api_payment',$data);
    }
}
