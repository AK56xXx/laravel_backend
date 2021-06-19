<?php

namespace App\Http\Controllers;

use App\Models\ConvoMessage;
use Illuminate\Http\Request;

class convoMessageController extends Controller
{
    public function index()
    {
        return ConvoMessage::all();
    }

    public function show(ConvoMessage $convoMessage)
    {
        return $convoMessage;
    }

    public function store(Request $request)
    {
        $user = $request->user();
     //   if($user->tokenCan('admin_privilege'))
        {$convoMessage = ConvoMessage::create($request->all());

        return response()->json($convoMessage, 201);}
     //   else{
     //       return response()->json('unauthorized modification, you do not have access',403);
       // }
    }

    public function update(Request $request, ConvoMessage $convoMessage)
    {
        $convoMessage->update($request->all());

        return response()->json($convoMessage, 200);
    }

    public function delete(ConvoMessage $convoMessage)
    {
        $convoMessage->delete();

        return response()->json(null, 204);
    }
}


