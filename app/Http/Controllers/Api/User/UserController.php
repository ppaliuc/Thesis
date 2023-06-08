<?php

namespace App\Http\Controllers\Api\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function update(Request $request)
    {
        try{
            $rules = [
                'photo' => 'mimes:jpeg,jpg,png,svg',
                'email' => 'unique:users,email,'.auth()->user()->id
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }

            $input = $request->all();
            $user = auth()->user();

            if ($file = $request->file('photo'))
            {
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images/',$name);
                @unlink('assets/images/'.$user->photo);

                $input['photo'] = $name;
                $input['is_provider'] = 0;
            }

            $user->update($input);
            $gs = Generalsetting::first();
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'type' => "Profile Update",
                    'cname' => $user->name,
                    'oamount' => "",
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendAutoMail($data);
            }
            else
            {
               $to = $user->email;
               $subject = "Your profile has been update";
               $msg = "Hello ".$user->name."!\nYour profile has been updated successfully.\nThank you.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);
            }

            return response()->json(['status' => true, 'data' => new UserResource($user), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status'=>false, 'data'=>[], 'error'=>$e->getMessage()]);
        }
    }

    public function updatePassword(Request $request) {
        $rules =
        [
          'current_password' => 'required',
          'new_password' => 'required',
          'renew_password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        try{
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)){
                if ($request->new_password == $request->renew_password){
                    $input['password'] = Hash::make($request->new_password);
                }else{
                    return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Confirm password does not match.']]);
                }
            }else{
                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Current password Does not match.']]);
            }
            $user->update($input);

            $gs = Generalsetting::first();
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'type' => "Password Changed",
                    'cname' => $user->name,
                    'oamount' => "",
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendAutoMail($data);
            }
            else
            {
               $to = $user->email;
               $subject = "Your password has been changed";
               $msg = "Hello ".$user->name."!\nYour password has been changed successfully.\nThank you.";
               $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
               mail($to,$subject,$msg,$headers);
            }

            return response()->json(['status' => true, 'data' => ['message' => 'Successfully changed your password.'], 'error' => []]);
        }
        catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }

    public function updateCurrency(Request $request){
        try{
            $rules =
            [
              'currency_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
              return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
            }
            
            $user = auth()->user();
            $input['currency_id'] = $request->currency_id;

            $user->update($input);

            return response()->json(['status' => true, 'data' => new UserResource($user), 'error' => []]);
        }catch(\Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => $e->getMessage()]);
        }
    }
}
