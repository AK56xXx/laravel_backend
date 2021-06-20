<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConvoMessage;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class instantChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function fetchMessages(Request $request)
    {
        
        
        
       

             $messages = DB::table('convo_messages')->where('sender_id',$request->input('sender_id'))
             ->where('receiver_id',$request->input('receiver_id'))
             ->get();
             return response()->json($messages, 200);
  
    }
    public function sendMessage( Request $request)
    {
     
        
        
            $message = new ConvoMessage;
            $message->message = $request->input('message');
            $message->sender_id =$request->input('sender_id');
            $message->receiver_id = $request->input('receiver_id');
            $message->attachment = $request->input('attachment');
            $message->save();
        
        
        return response()->json($message, 201);


    }
}
