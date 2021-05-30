<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConvoMessage;
use Illuminate\Http\Request;
use App\Models\User;


class instantChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function fetchMessages(User $user)
    {
        $convo = Conversation::where('sender', $user->id)
                                ->where('receiver', Auth()->user())
                                ->get();
        $messages = ConvoMessage::where('convo_id', $convo->id)->get();
        return response()->json($messages, 200);

    }
    public function sendMessage(User $receiver, Request $request)
    {
        $sender = Auth()->user();
        $convo = Conversation::where('sender', $sender)
                                ->where('receiver', $receiver)
                                ->get();
        if($convo->isNotEmpty()){
            $data=[
                "message"=>$request->content,
                "convo_id" =>$convo->first()->id,
                "attatchment" => $request->attatchemnt
            ];
            ConvoMessage::create($data);
        }else{
            $convoData=[
                "sender"=>$sender->id,
                "receiver"=>$receiver->id
            ];
            Conversation::create($convoData);
            $convo = Conversation::latest()->first();
            $data=[
                "message"=>$request->content,
                "convo_id" =>$convo->id,
                "attatchment" => $request->attatchemnt
            ];
            ConvoMessage::create($data);
        }
        $message = ConvoMessage::latest()->first();
        return response()->json($message, 201);


    }
}
