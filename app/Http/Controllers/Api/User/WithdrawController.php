<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WithdrawResource;
use App\Models\BankPlan;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function index(){
        try{
            $data = Withdraw::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => WithdrawResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function methods(){
        try{
            $data = WithdrawMethod::whereStatus(1)->orderBy('id','desc')->get();

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'amount' => 'required|gt:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        $user = auth()->user();

        if($user->bank_plan_id === null){
            return response()->json(['status' => false, 'data' => [], 'error' => 'You have to buy a plan to withdraw.']);
        }

        if(now()->gt($user->plan_end_date)){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Plan Date Expired.']);
        }

        $bank_plan = BankPlan::whereId($user->bank_plan_id)->first();
        $dailyWithdraws = Withdraw::whereDate('created_at', '=', date('Y-m-d'))->whereStatus('completed')->sum('amount');
        $monthlyWithdraws = Withdraw::whereMonth('created_at', '=', date('m'))->whereStatus('completed')->sum('amount');

        if($dailyWithdraws > $bank_plan->daily_withdraw){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Daily withdraw limit over.']);
        }

        if($monthlyWithdraws > $bank_plan->monthly_withdraw){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Monthly withdraw limit over.']);
        }

        if(baseCurrencyAmount($request->amount) > $user->balance){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Monthly withdraw limit over.']);
        }

        $withdrawcharge = WithdrawMethod::whereMethod($request->method)->first();
        $charge = $withdrawcharge->fixed;

        $currency = Currency::whereId($user->currency_id)->first();
        $amountToAdd = $request->amount/$currency->value;

        $amount = $amountToAdd;
        $fee = (($withdrawcharge->percentage / 100) * $request->amount) + $charge;
        $fee = $fee/$currency->value;
        $finalamount = $amount - $fee;

        if($finalamount < 0){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Request Amount should be greater than this '.$amountToAdd.' (USD)']);
        }

        if($finalamount > $user->balance){
            return response()->json(['status' => false, 'data' => [], 'error' => 'Insufficient Balance.']);
        }

        $finalamount = number_format((float)$finalamount,2,'.','');

        $user->balance = $user->balance - $amount;
        $user->update();

        $txnid = Str::random(12);
        $data = new Withdraw();
        $data['user_id'] = auth()->id();
        $data['method'] = $request->method;
        $data['txnid'] = $txnid;

        $data['amount'] = $finalamount;
        $data['fee'] = $fee;
        $data['details'] = $request->details;
        $data->save();

        $total_amount = $data->amount + $data->fee;

        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $finalamount;
        $trans->type = "Payout";
        $trans->profit = "minus";
        $trans->txnid = $txnid;
        $trans->user_id = $user->id;
        $trans->save();

        return response()->json(['status' => true, 'data' => new WithdrawResource($data), 'error' => []]);
    }

    public function details(Request $request, $id){
        try{
            $data = Withdraw::findOrFail($id);

            return response()->json(['status' => true, 'data' => new WithdrawResource($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
