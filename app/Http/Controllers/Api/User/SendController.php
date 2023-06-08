<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaveAccountResource;
use App\Http\Resources\TransferLogResource;
use App\Models\BalanceTransfer;
use App\Models\BankPlan;
use App\Models\Generalsetting;
use App\Models\SaveAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SendController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function accno($accno){
        if($data = User::where('account_number',$accno)->first()){
            return response()->json(['status' => true, 'data' => $data->name, 'error' => []]);
        }else{
            return response()->json(['status' => true, 'data' => [], 'error'=> 'No user found!']);
        }
    }

    public function store(Request $request){

        $rules = [
            'account_number' => 'required',
            'account_name' => 'required',
            'amount' => 'required|numeric|min:0'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['status' => true, 'data' => [], 'error'=> $validator->getMessageBag()->toArray()]);
        }

        $user = auth()->user();

        if($user->bank_plan_id === null){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'You have to buy a plan to send money.']);
        }

        if(now()->gt($user->plan_end_date)){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Plan Date Expired.']);
        }

        $bank_plan = BankPlan::whereId($user->bank_plan_id)->first();
        $dailySend = BalanceTransfer::whereUserId(auth()->id())->whereDate('created_at', '=', date('Y-m-d'))->whereStatus(1)->sum('amount');
        $monthlySend = BalanceTransfer::whereUserId(auth()->id())->whereMonth('created_at', '=', date('m'))->whereStatus(1)->sum('amount');

        if($dailySend > $bank_plan->daily_send){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Daily send limit over.']);
        }

        if($monthlySend > $bank_plan->monthly_send){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Monthly send limit over.']);
        }

        $gs = Generalsetting::first();
        $amount = apiCurrencyAmount($request->amount,$user->currency_id);

        if($request->account_number == $user->account_number){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'You can not send money yourself!!']);
        }

        if($request->amount < 0){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Request Amount should be greater than this!']);
        }

        if($amount > $user->balance){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Insufficient Account Balance.']);
        }

        if($receiver = User::where('account_number',$request->account_number)->first()){
            $txnid = Str::random(4).time();
            $data = new BalanceTransfer();
            $data->user_id = auth()->id();
            $data->receiver_id = $receiver->id;
            $data->transaction_no = $txnid;
            $data->type = 'own';
            $data->cost = 0;
            $data->amount = $amount;
            $data->status = 1;
            $data->save();

            $receiver->increment('balance',$amount);
            $user->decrement('balance',$amount);

            $apiData['data'] = new TransferLogResource($data);
            $apiData['save_user_account'] = route('api.user.save.account');
            $apiData['cancel'] = route('api.user.send.money.cancel');

            return response()->json(['status' => true, 'data' => $apiData, 'error' => []]);

        }else{
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Sender not found!']);
        }
    }

    public function saveAccount(Request $request){
        $savedUser = SaveAccount::whereUserId(auth()->id())->where('receiver_id',$request->receiver_id)->first();

        if($savedUser){
            return response()->json(['status' => true, 'data' => 'Already in Beneficiary.', 'error' => []]);
        }

        try{
            $data = new SaveAccount();

            $data->user_id = $request->user_id;
            $data->receiver_id = $request->receiver_id;
            $data->save();

            return response()->json(['status' => true, 'data' => new SaveAccountResource($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function list(){
        try {
            $data = SaveAccount::whereUserId(auth()->id())->get();

            return response()->json(['status' => true, 'data' => SaveAccountResource::collection($data), 'error' => []]);
        } catch (Exception $e) {
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

}
