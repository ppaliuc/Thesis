<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepositResource;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\PaymentGateway;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    public function history(){
        try{
            $deposits = Deposit::orderby('id','desc')->whereUserId(auth()->id())->paginate(10);
            return response()->json(['status' => true, 'data' => DepositResource::collection($deposits), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status'=>false, 'data'=>[], 'error'=>$e->getMessage()]);
        }
    }

    public function deposit(Request $request){
        try{
            $user = auth()->user();

            $currency = Currency::where('id',$user->currency_id)->first();
            $amountToAdd = $request->amount/$currency->value;

            $deposit = new Deposit();
            $deposit['deposit_number'] = Str::random(12);
            $deposit['user_id'] = $user->id;
            $deposit['currency_id'] = $currency->id;
            $deposit['amount'] = $amountToAdd;
            $deposit['status'] = "pending";
            $deposit->save();

            return response()->json(['status' => true, 'data' => new DepositResource($deposit), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status'=>false, 'data'=>[], 'error'=>$e->getMessage()]);
        }
    }

    public function confirm_deposit($id){
        $data['deposit'] = Deposit::findOrFail($id);
        $data['deposit_currency'] = Currency::findOrFail($data['deposit']->currency_id);
        $data['user'] = User::findOrFail($data['deposit']->user_id);

        $data['availableGatways'] = ['flutterwave','authorize.net','razorpay','mollie','paytm','instamojo','stripe','paypal','paystack'];
        $data['gateways'] = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();

        return view('user.deposit.api_deposit',$data);
    }
}

