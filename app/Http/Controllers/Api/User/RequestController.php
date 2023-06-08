<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoneyRequestResource;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\MoneyRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function requestHistory(){
        try{
            $requests = MoneyRequest::orderby('id','desc')->whereUserId(auth()->id())->paginate(10);
            return response()->json(['status' => true, 'data' => MoneyRequestResource::collection($requests), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status'=>false, 'data'=>[], 'error'=>$e->getMessage()]);
        }
    }

    public function store(Request $request){
        try{
            $rules = [
                'account_number' => 'required',
                'name' => 'required',
                'amount' => 'required|gt:0',
                'details' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            $user = auth()->user();

            $gs = Generalsetting::first();

            if($request->account_number == $user->account_number){
                return response()->json(['status' => false, 'data' => [], 'error' => 'You can not send money yourself!!']);
            }

            $user = User::where('account_number',$request->account_number)->first();
            if($user === null){
                return response()->json(['status' => false, 'data' => [], 'error' => 'No register user with this account number!']);
            }
            $currency = Currency::whereId($user->currency_id)->first();
            $amount = $request->amount/$currency->value;

            $cost = $gs->fixed_request_charge + ($request->amount/100) * $gs->percentage_request_charge;
            $cost = $cost/$currency->value;
            $finalAmount = $request->amount + $cost;


            $receiver = User::where('account_number',$request->account_number)->first();

            $txnid = Str::random(4).time();

            $data = new MoneyRequest();
            $data->user_id = auth()->id();
            $data->receiver_id = $receiver->id;
            $data->receiver_name = $receiver->name;
            $data->transaction_no = $txnid;
            $data->cost = $cost;
            $data->amount = $amount;
            $data->status = 0;
            $data->details = $request->details;
            $data->save();

            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $finalAmount;
            $trans->type = "Request Money";
            $trans->profit = "plus";
            $trans->txnid = $txnid;
            $trans->user_id = $user->id;
            $trans->save();

            return response()->json(['status' => true, 'data' => new MoneyRequestResource($data), 'error' => []]);

            return response()->json(['status' => true, 'data' => 'Request Money Send Successfully', 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }


    public function receiveHistory(){
        try{
            $requests = MoneyRequest::orderby('id','desc')->whereReceiverId(auth()->id())->paginate(10);
            return response()->json(['status' => true, 'data' => MoneyRequestResource::collection($requests), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status'=>false, 'data'=>[], 'error'=>$e->getMessage()]);
        }
    }

    public function send($id){
        try{
            $data = MoneyRequest::findOrFail($id);

            $sender = User::whereId($data->receiver_id)->first();
            $receiver = User::whereId($data->user_id)->first();


            if($data->amount > $sender->balance){
                return response()->json(['status' => false, 'data' => [], 'error' => 'You don,t have sufficient balance!']);
            }

            $finalAmount = $data->amount - $data->cost;

            $sender->decrement('balance',$data->amount);
            $receiver->increment('balance',$finalAmount);

            $data->update(['status'=>1]);

            $trans = new Transaction();
            $trans->email = auth()->user()->email;
            $trans->amount = $data->amount;
            $trans->type = "Request Money";
            $trans->profit = "minus";
            $trans->txnid = $data->transaction_no;
            $trans->user_id = auth()->id();
            $trans->save();

            $trans = new Transaction();
            $trans->email = $receiver->email;
            $trans->amount = $finalAmount;
            $trans->type = "Request Money";
            $trans->profit = "plus";
            $trans->txnid = $data->transaction_no;
            $trans->user_id = $receiver->id;
            $trans->save();

            return response()->json(['status' => true, 'data' => 'Money Send Successfully', 'error' => []]);

        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }

    public function details($id){
        try{
            $data = MoneyRequest::findOrFail($id);
            $from = User::whereId($data->user_id)->first();
            $to = User::whereId($data->receiver_id)->first();
            return response()->json(['status' => true, 'data' => new MoneyRequestResource($data), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }
}
