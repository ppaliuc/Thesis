<?php

namespace App\Http\Controllers\Api\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReplyResource;
use App\Http\Resources\TicketResource;
use App\Models\AdminUserConversation;
use App\Models\AdminUserMessage;
use App\Models\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('setapi');
    }

    public function index(){
        try{
            $data = AdminUserConversation::whereUserId(auth()->id())->orderBy('id','desc')->paginate(10);

            return response()->json(['status' => true, 'data' => TicketResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function show($id){
        try{
            $data = AdminUserMessage::whereConversationId($id)->orderBy('id','desc')->get();

            return response()->json(['status' => true, 'data' => ReplyResource::collection($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }
    }

    public function store(Request $request){
        $rules = [
            'subject' => 'required',
            'message' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        $data = new AdminUserConversation();
        $data->subject = $request->subject;
        $data->user_id= auth()->id();
        $data->message = $request->message;
        $data->save();

        $reply = new AdminUserMessage();
        $reply->conversation_id = $data->id;
        $reply->message = $request->message;
        $reply->user_id = auth()->id();
        $reply->save();

        return response()->json(['status' => true, 'data' => new TicketResource($data), 'error' => []]);
    }

    public function reply(Request $request){
        $rules = [
            'conversation_id' => 'required',
            'message' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        if(!auth()->id()){
            auth()->logout();
            return response()->json(['status' => false, 'data' => [], 'error' => 'Login First!']);
        }

        try{
            $data = new AdminUserMessage();
            $data->conversation_id = $request->conversation_id;
            $data->message = $request->message;
            $data->user_id = auth()->id();
            $data->save();

            return response()->json(['status' => true, 'data' => new ReplyResource($data), 'error' => []]);
        }catch(Exception $e){
            return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
        }

    }

    public function delete($id)
    {
        $conv = AdminUserConversation::findOrfail($id);
        if($conv->messages->count() > 0)
        {
            foreach ($conv->messages as $key) {
                $key->delete();
            }
        }
        $conv->delete();

        return response()->json(['status' => true, 'data' => 'Message Deleted Successfully', 'error' => []]);
    }
}
