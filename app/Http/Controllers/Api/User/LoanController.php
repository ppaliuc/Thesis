<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstallmentLogResource;
use App\Http\Resources\LoanResource;
use App\Models\InstallmentLog;
use App\Models\LoanPlan;
use App\Models\UserLoan;
use App\Http\Resources\LoanPlanResource;
use App\Models\BankPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function loanPlans(){
        try{
            $data = LoanPlan::orderBy('id','desc')->whereStatus(1)->get();

            return response()->json(['status' => true, 'data' => LoanPlanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function loanAmount(Request $request){
        if(!auth()->user()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        $user = auth()->user();
        $plan = LoanPlan::whereId($request->planId)->first();
        $amount = $request->amount;

        $min_amount = convertedApiAmount($plan->min_amount,$user->currency_id);
        $max_amount = convertedApiAmount($plan->max_amount,$user->currency_id);

        $requireInformations = [];
        if($plan->required_information){
            foreach(json_decode($plan->required_information) as $key=>$value){
                $requireInformations[$value->type] = str_replace(' ', '_', $value->field_name);
            }
        }

        if($amount >= $min_amount && $amount <= $max_amount){
            $data['title'] = $plan->title;
            $data['plan_id'] = $plan->id;
            $data['loan_amount'] = apiConvertedAmount($amount);
            $perInstallment = ($amount * $plan->per_installment)/100;
            $data['per_installment'] = apiConvertedAmount($perInstallment);
            $data['total_installment'] = $plan->total_installment;
            $data['total_amount_pay'] = apiConvertedAmount($perInstallment * $plan->total_installment);
            $data['dynamic_fields'] = $requireInformations;

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        }else{
            return response()->json(['status' => true, 'data' => [], 'error' => 'Request Money should be between minium and maximum amount!']);
        }
    }

    public function loanRequest(Request $request){
        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        $user = auth()->user();

        if($user->bank_plan_id === null){
            return response()->json(['status' => false, 'data' => [], 'error' => 'You have to buy a plan to loan!']);
        }

        if(now()->gt($user->plan_end_date)){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Plan Date Expired!']);
        }
        $bank_plan = BankPlan::whereId($user->bank_plan_id)->first();
        $monthlyLoans = UserLoan::whereUserId(auth()->id())->whereMonth('created_at', '=', date('m'))->whereStatus('approve')->sum('loan_amount');

        if($monthlyLoans > $bank_plan->loan_amount){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Monthly loan limit over.']);
        }

        $data = new UserLoan();
        $input = $request->all();

        $loan = LoanPlan::findOrFail($request->plan_id);

        $requireInformations = [];
        if($loan->required_information){
            foreach(json_decode($loan->required_information) as $key=>$value){
                $requireInformations[$value->type][$key] = str_replace(' ', '_', $value->field_name);
            }
        }


        $details = [];
        foreach($requireInformations as $key=>$infos){
            foreach($infos as $index=>$info){
                if($request->has($info)){
                    if($request->hasFile($info)){
                        if ($file = $request->file($info))
                        {
                           $name = Str::random(8).time().'.'.$file->getClientOriginalExtension();
                           $file->move('assets/images',$name);
                           $details[$info] = [$name,$key];
                        }
                    }else{
                        $details[$info] = [$request->$info,$key];
                    }
                }
            }
        }


        if(!empty($details)){
            $required_information = json_encode($details,true);
        }

        $txnid = Str::random(4).time();
        $data->plan_id = $request->plan_id;
        $data->transaction_no = $txnid;
        $data->user_id = auth()->id();
        $data->next_installment = now()->addDays($loan->installment_interval);
        $data->given_installment = 0;
        $data->total_installment = $loan->total_installment;
        $data->paid_amount = 0;
        $data->loan_amount = apiCurrencyAmount($request->loan_amount,$user->currency_id);
        $data->per_installment_amount = apiCurrencyAmount($request->per_installment_amount,$user->currency_id);
        $data->total_amount = apiCurrencyAmount($request->total_amount,$user->currency_id);
        if(!empty($details)){
            $data->required_information = $required_information;
        }
        $data->save();

        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = apiCurrencyAmount($request->loan_amount,$user->currency_id);
        $trans->type = "Loan";
        $trans->profit = "plus";
        $trans->txnid = $txnid;
        $trans->user_id = $user->id;
        $trans->save();

        return response()->json(['status' => true, 'data' => new LoanResource($data), 'error' => []]);
    }

    public function loans(){
        try{
            $data = UserLoan::whereUserId(auth()->id())->orderby('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => LoanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function pendingLoans(){
        try{
            $data = UserLoan::whereStatus(0)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => LoanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function runningLoans(){
        try{
            $data = UserLoan::whereStatus(1)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => LoanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function paidLoans(){
        try{
            $data = UserLoan::whereStatus(3)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => LoanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function rejectedLoans(){
        try{
            $data = UserLoan::whereStatus(2)->whereUserId(auth()->id())->orderby('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => LoanResource::collection($data), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function logs($id){
        try{
            $loan = UserLoan::findOrfail($id);
            $logs = InstallmentLog::whereTransactionNo($loan->transaction_no)->whereUserId(auth()->id())->orderby('id','desc')->paginate(20);

            return response()->json(['status' => true, 'data' => InstallmentLogResource::collection($logs), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
