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
        $convo = DB::table('conversations')->where('sender', $request->input('sender_id'))
                                ->where('receiver',$request->input('receiver_id'))
                                ->get();
        
        
        if ($convo->isNotEmpty()){

             $messages = DB::table('convo_messages')->where('convo_id', $convo->first()->id)
             ->get();
             return response()->json($messages, 200);
        }
        return $convo;

    }
    public function sendMessage( Request $request)
    {
     
        $convo = Conversation::where('sender', $request->input('sender_id'))
                                ->where('receiver', $request->input('receiver_id'))
                                ->get();
        if($convo->isNotEmpty()){
            $message = new ConvoMessage;
            $message->message = $request->input('message');
            $message->convo_id = $convo->first()->id;
            $message->attachment = $request->input('attachment');
            $message->save();
        }else{
            
            $convo = new Conversation;
            $convo->sender = $request->input('sender_id');
            $convo->receiver = $request->input('receiver_id');
            $convo->save();
            $message = new ConvoMessage;
            $message->message = $request->input('message');
            $message->convo_id = $convo->id;
            $message->attachment = $request->input('attachment');
            $message->save();
        }
        $message = ConvoMessage::latest();
        return response()->json($message, 201);


    }
}
