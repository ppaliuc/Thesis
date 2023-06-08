<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Invest;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ReferralBonus;
use App\Models\AdminUserConversation;

class DashboardController extends Controller
{
    public function dashboard(){
        try{
            $user = auth()->guard('api')->user();
            $data['account_number'] = $user->account_number;
            $data['available_balance'] = apiConvertedAmount($user->balance);
            $data['deposits'] = count($user->deposits);
            $data['withdraws'] = count($user->withdraws);
            $data['total_transactions'] = count($user->transactions);
            $data['loans'] = count($user->loans);
            $data['dps'] = count($user->dps);
            $data['fdr'] = count($user->fdr);
            $data['referral_link'] = url('/').'?reff='.$user->affilate_code;
            $data['transactions'] = TransactionResource::collection(Transaction::whereUserId(auth()->id())->orderBy('id','desc')->limit(5)->get());

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }

    public function transactions(Request $request){
        try{
            $transactions = Transaction::whereUserId(auth()->id())->orderBy('id','desc')->paginate(20);
            return response()->json(['status' => true, 'data' => TransactionResource::collection($transactions), 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }
}
