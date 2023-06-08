<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DpsPlanResource;
use App\Http\Resources\DpsResource;
use App\Http\Resources\InstallmentLogResource;
use App\Models\DpsPlan;
use App\Models\InstallmentLog;
use App\Models\Transaction;
use App\Models\UserDps;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function dpsPlans(){
        try{
            $data = DpsPlan::orderBy('id','desc')->whereStatus(1)->get();

            return response()->json(['status' => true, 'data' => DpsPlanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function dpsApply($id){
        try{
            $dps = DpsPlan::findOrFail($id);
            $data['plan_title'] = $dps->title;
            $data['total_installment'] = $dps->total_installment;
            $data['interest_rate'] = $dps->interest_rate.'%';
            $data['dps_plan_id'] = $dps->id;
            $data['per_installment'] = apiConvertedAmount($dps->per_installment);
            $data['deposit_amount'] = apiConvertedAmount($dps->final_amount);
            $data['matured_amount'] = apiConvertedAmount($dps->final_amount + $dps->user_profit);

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);

        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function dpsSubmit(Request $request){

        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }
        $user = auth()->user();

        if($user->balance >= apiCurrencyAmount($request->per_installment,$user->currency_id)){
            $data = new UserDps();

            $plan = DpsPlan::findOrFail($request->dps_plan_id);
            $data->transaction_no = Str::random(4).time();
            $data->user_id = auth()->id();
            $data->dps_plan_id = $plan->id;
            $data->per_installment = $plan->per_installment;
            $data->installment_interval = $plan->installment_interval;
            $data->total_installment = $plan->total_installment;
            $data->interest_rate = $plan->interest_rate;
            $data->given_installment = 1;
            $data->deposit_amount = apiCurrencyAmount($request->deposit_amount,$user->currency_id);
            $data->matured_amount = apiCurrencyAmount($request->matured_amount,$user->currency_id);
            $data->paid_amount = apiCurrencyAmount($request->per_installment,$user->currency_id);
            $data->status = 1;
            $data->next_installment = Carbon::now()->addDays($plan->installment_interval);
            $data->save();

            $user->decrement('balance',apiCurrencyAmount($request->per_installment,$user->currency_id));

            $log = new InstallmentLog();
            $log->user_id = auth()->id();
            $log->transaction_no = $data->transaction_no;
            $log->type = 'dps';
            $log->amount = apiCurrencyAmount($request->per_installment,$user->currency_id);
            $log->save();

            $trans = new Transaction();
            $trans->email = auth()->user()->email;
            $trans->amount = apiCurrencyAmount($request->per_installment,$user->currency_id);
            $trans->type = "Dps";
            $trans->profit = "minus";
            $trans->txnid = $data->transaction_no;
            $trans->user_id = auth()->id();
            $trans->save();

            return response()->json(['status' => true, 'data' => new DpsResource($data), 'error' => []]);
        }else{
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'You Don,t have sufficient balance']]);
        }
    }

    public function index(){
        try{
            $data = UserDps::whereUserId(auth()->id())->orderby('id','desc')->paginate(10);
            return response()->json(['status' => true, 'data' => DpsResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function running(){
        try{
            $data = UserDps::whereStatus(1)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);
            return response()->json(['status' => true, 'data' => DpsResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function matured(){
        try{
            $data = UserDps::whereStatus(2)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);
            return response()->json(['status' => true, 'data' => DpsResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function logs($id){
        try{
            $loan = UserDps::findOrfail($id);
            $logs = InstallmentLog::whereTransactionNo($loan->transaction_no)->whereUserId(auth()->id())->orderby('id','desc')->orderby('id','desc')->paginate(20);

            return response()->json(['status' => true, 'data' => InstallmentLogResource::collection($logs), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
