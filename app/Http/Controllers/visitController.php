<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class visitController extends Controller
{
    public function index()
    {
        return Visit::all();
    }

    public function show(Visit $visit)
    {
        return $visit;
    }

    public function visitsByState(int $etat)
    {
        $visits = DB::table('visits')->where('accepter', $etat)->get();
        return response()->json($visits, 200);
        
    }

    public function store(Request $request)
    {
     /*   $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$visit = Visit::create($request->all());

        return response()->json($visit, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
        }*/

        $demandes = DB::table('visits')
        ->where('mail',$request->input('mail'))
        ->where('accepter', '0')
        ->count();
        if($demandes==0){
            $user = $request->user();
            
            $visit = Visit::create($request->all());

            return response()->json($visit, 201);
        }else{
            return response()->json("previous demand not answered yet, you can not send new demands", 403);
        }



    }

    public function update(Request $request, Visit $visit)
    {
        $visit->update($request->all());

        return response()->json($visit, 200);
    }

    public function delete(Visit $visit)
    {
        $visit->delete();

        return response()->json(null, 204);
    }
}


