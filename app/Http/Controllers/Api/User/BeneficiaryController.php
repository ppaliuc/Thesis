<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeneficiariesResource;
use App\Http\Resources\OtherBankResource;
use App\Http\Resources\TransferLogResource;
use App\Models\BalanceTransfer;
use App\Models\BankPlan;
use App\Models\Beneficiary;
use App\Models\Generalsetting;
use App\Models\OtherBank;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BeneficiaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function index(){
        try{
            $data = Beneficiary::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => BeneficiariesResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function otherBanks(){
        try{
            $data = OtherBank::orderBy('id','desc')->get();

            return response()->json(['status' => true, 'data' => OtherBankResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function otherBanksTransfer(){
        try{
            $data = Beneficiary::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => BeneficiariesResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function transfer($id){
        try{
            $beneficiary = Beneficiary::findOrFail($id);

            $data['beneficiary_id'] = $beneficiary->id;
            $data['other_bank_id'] = $beneficiary->other_bank_id;
            $data['min_amount'] = showNameAmount($beneficiary->bank->min_limit);
            $data['max_amount'] = showNameAmount($beneficiary->bank->max_limit);
            $data['daily_amount_limit'] = showNameAmount($beneficiary->bank->daily_maximum_limit);
            $data['monthly_amount_limit'] = showNameAmount($beneficiary->bank->monthly_maximum_limit);
            $data['daily_total_transaction'] = showNameAmount($beneficiary->bank->daily_total_transaction);
            $data['monthly_total_transaction'] = showNameAmount($beneficiary->bank->monthly_total_transaction);
            $data['bank_name'] = $beneficiary->bank->title;
            $data['account_name'] = $beneficiary->account_name;

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function sendMoney(Request $request){

        $rules = [
            'amount' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['status' => true, 'data' => [], 'error'=> $validator->getMessageBag()->toArray()]);
        }

        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        $user = auth()->user();
        if($user->bank_plan_id === null){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'You have to buy a plan to withdraw.']]);
        }

        if(now()->gt($user->plan_end_date)){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Plan Date Expired.']]);
        }

        $bank_plan = BankPlan::whereId($user->bank_plan_id)->first();
        $dailySend = BalanceTransfer::whereUserId(auth()->id())->whereDate('created_at', '=', date('Y-m-d'))->whereStatus(1)->sum('amount');
        $monthlySend = BalanceTransfer::whereUserId(auth()->id())->whereMonth('created_at', '=', date('m'))->whereStatus(1)->sum('amount');

        if($dailySend > $bank_plan->daily_send){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Daily send limit over.']]);
        }

        if($monthlySend > $bank_plan->monthly_send){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Monthly send limit over.']]);
        }

        $amount = apiCurrencyAmount($request->amount,$user->currency_id);

        $gs = Generalsetting::first();
        $otherBank = OtherBank::whereId($request->other_bank_id)->first();
        $dailyTransactions = BalanceTransfer::whereType('other')->whereUserId(auth()->user()->id)->whereDate('created_at', now())->get();
        $monthlyTransactions = BalanceTransfer::whereType('other')->whereUserId(auth()->user()->id)->whereMonth('created_at', now()->month())->get();

        if ($otherBank ) {
            $cost = $otherBank->fixed_charge + ($request->amount/100) * $otherBank->percent_charge;
            $cost = apiCurrencyAmount($cost,$user->currency_id);
            $finalAmount = $amount + $cost;

            if($otherBank->min_limit > $amount){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Request Amount should be greater than this']]);
            }

            if($otherBank->max_limit < $amount){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Request Amount should be less than this']]);
            }

            if($otherBank->daily_maximum_limit <= $finalAmount){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Your daily limitation of transaction is over.']]);
            }

            if($otherBank->daily_maximum_limit <= $dailyTransactions->sum('final_amount')){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Your daily limitation of transaction is over.']]);
            }

            if($otherBank->daily_total_transaction <= count($dailyTransactions)){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Your daily number of transaction is over.']]);
            }

            if($otherBank->monthly_maximum_limit < $monthlyTransactions->sum('final_amount')){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Your monthly limitation of transaction is over.']]);
            }

            if($otherBank->monthly_total_transaction <= count($monthlyTransactions)){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Your monthly number of transaction is over!']]);
            }

            if($user->balance<0 && ($finalAmount > $user->balance)){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Insufficient Balance!']]);
            }

            if($amount > $user->balance){
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Insufficient Account Balance.']]);
            }

            $txnid = Str::random(4).time();

            $data = new BalanceTransfer();
            $data->user_id = auth()->id();
            $data->transaction_no = $txnid;
            $data->other_bank_id = $request->other_bank_id;
            $data->beneficiary_id = $request->beneficiary_id;
            $data->type = 'other';
            $data->cost = $cost;
            $data->amount = $amount;
            $data->final_amount = $finalAmount;
            $data->status = 0;
            $data->save();

            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $finalAmount;
            $trans->type = "Send Money";
            $trans->profit = "minus";
            $trans->txnid = $txnid;
            $trans->user_id = $user->id;
            $trans->save();

            $user->decrement('balance',$finalAmount);

            return response()->json(['status' => false, 'data' => new TransferLogResource($data), 'error' => [] ]);
        }

    }

    public function store(Request $request){
        try{
            $rules = [
                'other_bank_id' => 'required',
                'account_number' => 'required',
                'account_name' => 'required',
                'nick_name' => 'required',
            ];


            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            if(!auth()->id()){
                auth()->logout();
                return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
            }

            $data = new Beneficiary();
            $input = $request->all();

            $bank = OtherBank::findOrFail($request->other_bank_id);

            $requireInformations = [];
            foreach(json_decode($bank->required_information) as $key=>$value){
                $requireInformations[$value->type] = str_replace(' ', '_', $value->field_name);
            }

            $details = [];
            foreach($requireInformations as $key=>$info){
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

            $input['details'] = json_encode($details,true);

            $input['user_id'] = auth()->id();
            $data->fill($input)->save();

            return response()->json(['status' => false, 'data' => new BeneficiariesResource($data), 'error' => [] ]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function show($id){
        try{
            $data = Beneficiary::findOrFail($id);

            return response()->json(['status' => true, 'data' => new BeneficiariesResource($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
