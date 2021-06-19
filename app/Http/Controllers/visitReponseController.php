<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\VisitReponse;
use Mail;


class visitReponseController extends Controller
{
    public function repondre_positif(Visit $visit,Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege') || $user->tokenCan('direct_privilege') ){
            VisitReponse::create($request->all());
            $visitReponse = VisitReponse::latest();
            $visitReponse->update(['visit_id'=>$visit->id]);
            $visit->update(['accepter'=> 1]);
            $visit->save();
            
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('visitConfirmationMail', $data, function($message) use($visit) {
                $message->to($visit->mail)
                ->subject('Visit confirmation');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Technologie');
             });
            return response()->json($visitReponse, 201);

        }
    
    }
    public function repondre_negatif(Visit $visit, Request $request)
    {

        $user = $request->user();
        if($user->tokenCan('admin_privilege') || $user->tokenCan('direct_privilege') ){
            VisitReponse::create($request->all());
            $visitReponse = VisitReponse::latest();
            $visitReponse->update(['visit_id'=>$visit->id]);
            $visit->update(['accepter'=> 2]);
            $visit->save();
            
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('visitRejectionMail', $data, function($message) use($visit) {
                $message->to($visit->mail)
                ->subject('Visit rejection');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Technologie');
             });
            return response()->json($visitReponse, 201);

        }
    }
}
