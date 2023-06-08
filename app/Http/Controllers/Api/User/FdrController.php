<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FdrPlanResource;
use App\Http\Resources\FdrResource;
use App\Models\FdrPlan;
use App\Models\Transaction;
use App\Models\UserFdr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FdrController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function fdrPlans(){
        try{
            $data = FdrPlan::orderBy('id','desc')->whereStatus(1)->get();

            return response()->json(['status' => true, 'data' => FdrPlanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function fdrAmount(Request $request){
        if(!auth()->user()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        $user = auth()->user();
        $plan = FdrPlan::whereId($request->planId)->first();
        $amount = $request->amount;

        $min_amount = convertedApiAmount($plan->min_amount,$user->currency_id);
        $max_amount = convertedApiAmount($plan->max_amount,$user->currency_id);

        if($amount >= $min_amount && $amount <= $max_amount ){
            $data['plan_id'] = $plan->id;
            $data['plan_title'] = $plan->title;
            $data['locked_in_period'] = $plan->matured_days.' Days';
            $data['get_profit'] = $plan->interval_type == 'partial' ? $plan->interest_interval.' Days': 'After Locked Period';
            $data['fdr_amount'] = $amount;
            $data['interest_rate_in_total_deposit'] = $plan->interest_rate.'%';
            $data['amount_to_get'] = apiConvertedAmount(($amount * $plan->interest_rate)/100,$user->currency_id);

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        }else{
            return response()->json(['status' => true, 'data' => [], 'error' => 'Request Money should be between minium and maximum amount!']);
        }
    }

    public function fdrRequest(Request $request){
        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }


        $user = auth()->user();
        if($user->balance >= apiCurrencyAmount($request->fdr_amount,$user->currency_id)){

            $data = new UserFdr();
            $plan = FdrPlan::findOrFail($request->plan_id);

            $data->transaction_no = Str::random(4).time();
            $data->user_id = auth()->id();
            $data->fdr_plan_id = $plan->id;
            $data->amount = apiCurrencyAmount($request->fdr_amount,$user->currency_id);
            $data->profit_type = $plan->interval_type;
            $data->profit_amount = apiCurrencyAmount($request->profit_amount,$user->currency_id);
            $data->interest_rate = $plan->interest_rate;

            if($plan->interval_type == 'partial'){
                $data->next_profit_time = Carbon::now()->addDays($plan->interest_interval);
            }
            $data->matured_time = Carbon::now()->addDays($plan->matured_days);
            $data->status = 1;
            $data->save();

            $user->decrement('balance',apiCurrencyAmount($request->fdr_amount,$user->currency_id));

            $trans = new Transaction();
            $trans->email = auth()->user()->email;
            $trans->amount = apiCurrencyAmount($request->fdr_amount,$user->currency_id);
            $trans->type = "Fdr";
            $trans->profit = "minus";
            $trans->txnid = $data->transaction_no;
            $trans->user_id = auth()->id();
            $trans->save();

            return response()->json(['status' => true, 'data' => 'Data added successfully', 'error' => []]);
        }else{
            return response()->json(['status' => true, 'data' => [], 'error' => 'You Don,t have sufficient balance']);
        }
    }

    public function index(){
        try{
            $data = UserFdr::whereUserId(auth()->id())->orderby('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => FdrResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function running(){
        try{
            $data = UserFdr::whereStatus(1)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);
            return response()->json(['status' => true, 'data' => FdrResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }

    }

    public function closed(){
        try{
            $data = UserFdr::whereStatus(2)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);
            return response()->json(['status' => true, 'data' => FdrResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
