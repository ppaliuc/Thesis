<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralCommissionResource;
use App\Http\Resources\ReferrarResource;
use App\Models\ReferralBonus;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }
    
    public function referred(){
        try{
            $referreds = User::where('referral_id',auth()->id())->orderBy('id','desc')->paginate(20);

            return response()->json(['status' => true, 'data' => ReferrarResource::collection($referreds), 'error' => []]);

        }catch(\Exception $e){
            return response()->json(['status'=> false, 'data'=>[], 'error'=> $e->getMessage()]);
        }
    }

    public function commissions(){
        try{
            $commissions = ReferralBonus::where('to_user_id',auth()->id())->orderBy('id','desc')->paginate(20);
            return response()->json(['status' => true, 'data' => ReferralCommissionResource::collection($commissions), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status'=> false, 'data'=>[], 'error'=> $e->getMessage()]);
        }
    }
}
