<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\MeetingReponse;
use Mail;

class meetingReponseController extends Controller
{
    //
    /*
    *
    *
    */
    public function repondre_positif(Meeting $meeting,Request $request)
    {
            MeetingReponse::create($request->all());
            $meetingReponse = MeetingReponse::latest()->first();
            $meetingReponse->update(['meeting_id'=>$meeting->id]);
            $meeting->update(['accepter'=> 1]);
            $meeting->save();
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('meetingConfirmationMail', $data, function($message) use($meeting) {
                $message->to($meeting->mail)
                ->subject('Meeting confirmation');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Telecom');
             });
            return response()->json("reponse créer", 201);
    }
    public function repondre_negatif(Meeting $meeting)
    {
        //TODO : send denial email
    }
}
