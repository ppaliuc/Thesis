<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransferLogResource;
use App\Models\BalanceTransfer;
use Illuminate\Http\Request;

class TransferLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function index(){
        try{
            $data = BalanceTransfer::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => TransferLogResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
