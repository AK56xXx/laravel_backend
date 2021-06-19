<?php

namespace App\Http\Controllers;
use App\Models\Stage;
use App\Models\StageReponse;
use Mail;

use Illuminate\Http\Request;

class stageReponseController extends Controller
{
    public function repondre_positif(Stage $stage,Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege') || $user->tokenCan('direct_privilege') ){
            StageReponse::create($request->all());
            $stageReponse = StageReponse::latest();
            $stageReponse->update(['stage_id'=>$stage->id]);
            $stage->update(['accepted'=> 1]);
            $stage->save();
            
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('stageConfirmationMail', $data, function($message) use($stage) {
                $message->to($stage->mail)
                ->subject('Stage confirmation');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Technologie');
             });
            return response()->json($stageReponse, 201);

        }
    
    }
    public function repondre_negatif(Stage $stage, Request $request)
    {

        $user = $request->user();
        if($user->tokenCan('admin_privilege') || $user->tokenCan('direct_privilege') ){
            StageReponse::create($request->all());
            $stageReponse = StageReponse::latest();
            $stageReponse->update(['stage_id'=>$stage->id]);
            $stage->update(['accepted'=> 2]);
            $stage->save();
            
            //TODO :  the callback function does not see the $meeting param
            $data = $request->all();

            Mail::send('stageRejectionMail', $data, function($message) use($stage) {
                $message->to($stage->mail)
                ->subject('Stage rejection');
                $message->from('tt.corp.tn@gmail.com', 'Tunisie Technologie');
             });
            return response()->json($stageReponse, 201);

        }
    }
}
