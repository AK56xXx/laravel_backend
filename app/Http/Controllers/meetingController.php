<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class meetingController extends Controller
{
    public function index()
    {
        return Meeting::all();
    }
    public function meetingsByState(int $etat)
    {
        $meetings = DB::table('meetings')->where('accepter', $etat)->get();
        return response()->json($meetings, 200);
        
    }

    public function show(Meeting $meeting)
    {
        return $meeting;
    }

    public function store(Request $request)
    {
        $demandes = DB::table('meetings')
        ->where('mail',$request->input('mail'))
        ->where('accepter', '0')
        ->count();
        if($demandes==0){
            $user = $request->user();
            
            $meeting = Meeting::create($request->all());

            return response()->json($meeting, 201);
        }else{
            return response()->json("previous demand not answered yet, you can not send new demands", 403);
        }
        
    }

    public function update(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());

        return response()->json($meeting, 200);
    }

    public function delete(Meeting $meeting)
    {
        $meeting->delete();

        return response()->json(null, 204);
    }

}


