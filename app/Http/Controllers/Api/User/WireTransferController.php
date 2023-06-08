<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\WireTransferBankResource;
use App\Http\Resources\WireTransferResource;
use App\Models\BalanceTransfer;
use App\Models\BankPlan;
use App\Models\WireTransfer;
use App\Models\WireTransferBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WireTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function banks(){
        try{
            $data = WireTransferBank::whereStatus(1)->orderBy('id','desc')->get();
            return response()->json(['status' => true, 'data' => WireTransferBankResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function index(){
        try{
            $data = WireTransfer::where('user_id',auth()->id())->orderBy('id','desc')->paginate(20);

            return response()->json(['status' => true, 'data' => WireTransferResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }


    public function store(Request $request){
        $rules=[
            'wire_transfer_bank_id' => 'required',
            'currency' => 'required',
            'routing_number' => 'required',
            'country' => 'required',
            'account_number' => 'required',
            'account_holder_name' => 'required',
            'amount' => 'required|numeric|min:0',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['status' => true, 'data' => [], 'error'=> $validator->getMessageBag()->toArray()]);
        }

        $user = auth()->user();

        if($user->bank_plan_id === null){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'You have to buy a plan to withdraw.']);
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

        if($request->amount > $user->balance){
            return response()->json(['status' => true, 'data' => [], 'error'=> 'Insufficient Account Balance.']);
        }

        $data = new WireTransfer();
        $data->transaction_no = Str::random(4).time();
        $data->user_id = auth()->id();
        $data->wire_transfer_bank_id = $request->wire_transfer_bank_id;
        $data->currency = $request->currency;
        $data->routing_number = $request->routing_number;
        $data->country = $request->country;
        $data->swift_code = $request->swift_code;
        $data->account_number = $request->account_number;
        $data->account_holder_name = $request->account_holder_name;
        $data->amount = apiCurrencyAmount($request->amount,$user->currency_id);
        $data->note = $request->note;
        $data->save();

        $user->decrement('balance',$request->amount);

        return response()->json(['status' => true, 'data' => new WireTransferResource($data), 'error' => []]);
    }

    public function details($id){
        try{
            $data = WireTransfer::whereId($id)->first();
            return response()->json(['status' => true, 'data' => new WireTransferResource($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
