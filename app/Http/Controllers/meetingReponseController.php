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
        $user = $request->user();
        if($user->tokenCan('admin_privilege') || $user->tokenCan('direct_privilege') ){
            MeetingReponse::create($request->all());
            $meetingReponse = MeetingReponse::latest();
            $meetingReponse->update(['meeting_id'=>$meeting->id]);
            $meeting->update(['accepter'=> 1]);
            $meeting->save();
            
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('meetingConfirmationMail', $data, function($message) use($meeting) {
                $message->to($meeting->mail)
                ->subject('Meeting confirmation');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Technologie');
             });
            return response()->json($meetingReponse, 201);

        }
    
    }
    public function repondre_negatif(Meeting $meeting, Request $request)
    {

        $user = $request->user();
        if($user->tokenCan('admin_privilege') || $user->tokenCan('direct_privilege') ){
            MeetingReponse::create($request->all());
            $meetingReponse = MeetingReponse::latest();
            $meetingReponse->update(['meeting_id'=>$meeting->id]);
            $meeting->update(['accepter'=> 2]);
            $meeting->save();
            
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('meetingRejectionMail', $data, function($message) use($meeting) {
                $message->to($meeting->mail)
                ->subject('Meeting rejection');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Technologie');
             });
            return response()->json($meetingReponse, 201);

        }
    }
}
