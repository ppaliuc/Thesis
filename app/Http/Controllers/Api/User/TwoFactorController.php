<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Classes\GoogleAuthenticator;
use App\Http\Resources\UserResource;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function showTwoFactorForm()
    {
        try{
            $user = auth()->user();
            $gnl = Generalsetting::first();
            $ga = new GoogleAuthenticator();

            $data['secret'] = $ga->createSecret();
            $data['qrCodeUrl'] = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $data['secret']);
            $data['qrPhoto'] = '<img class="mx-auto" src="'.$data['qrCodeUrl'].'">';

            return response()->json(['status' => true, 'data' => $data, 'error' => []]);

        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function createTwoFactor(Request $request)
    {
        try{
            $rules = [
                'key' => 'required',
                'code' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            $user = auth()->user();


            $ga = new GoogleAuthenticator();
            $secret = $request->key;
            $oneCode = $ga->getCode($secret);

            if ($oneCode == $request->code) {
                $user->go = $request->key;
                $user->twofa = 1;
                $user->save();

                return response()->json(['status' => true, 'data' => ['Two factor authentication activated'], 'error' => []]);
            }
            return response()->json(['status' => true, 'data' => [], 'error'=>['message'=>['Something went wrong!']]]);

        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }

    }


    public function disableTwoFactor(Request $request)
    {
        try{
            $rules = [
                'code' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            $user = auth()->user();
            $ga = new GoogleAuthenticator();

            $secret = $user->go;
            $oneCode = $ga->getCode($secret);
            $userCode = $request->code;

            if ($oneCode == $userCode) {
                $user->go = null;
                $user->twofa = 0;
                $user->save();

                return response()->json(['status' => true, 'data' => ['Two factor authentication disabled'], 'error' => []]);
            }
            return response()->json(['status' => true, 'data' => [], 'error'=>['message'=>['Something went wrong!']]]);

        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function otp(Request $request){
        try{
            $rules = [
                'otp' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            $user = auth()->user();
            $googleAuth = new GoogleAuthenticator();
            $otp =  $request->otp;

            $secret = $user->go;
            $oneCode = $googleAuth->getCode($secret);
            $userOtp = $otp;
            if ($oneCode == $userOtp) {
                $user->verified = 1;
                $user->otp_submit = 1;
                $user->save();

                return response()->json(['status' => true, 'data' => new UserResource($user), 'error' => []]);
            } else {
                return response()->json(['status' => true, 'data' => [], 'error'=>['message'=>['OTP not match!']]]);
            }
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }
}
