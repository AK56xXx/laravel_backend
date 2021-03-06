<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class chatMessageController extends Controller
{

  

    public function index()
    {
        return ChatMessage::all();
    }

    public function show(ChatMessage $chatMessage)
    {
        return $chatMessage;
    }
    

    public function store(Request $request)
    {
        $user = $request->user();
      //  if($user->tokenCan('admin_privilege'))
        {$chatMessage = ChatMessage::create($request->all());

        return response()->json($chatMessage, 201);}
       // else{
           // return response()->json('unauthorized modification, you do not have access',403);
      //  }
    }

    public function send(Request $request)
    {
        $message = new ChatMessage;
        $message->message = $request->input('message');
        $message->attachment = $request->input('attachment');
        $message->sender = $request->input('sender_id');
        $message->save();
        return response()->json($message,201);
    }


    public function update(Request $request, ChatMessage $chatMessage)
    {
        $chatMessage->update($request->all());

        return response()->json($chatMessage, 200);
    }

    public function delete(ChatMessage $chatMessage)
    {
        $chatMessage->delete();

        return response()->json(null, 204);
    }
}


