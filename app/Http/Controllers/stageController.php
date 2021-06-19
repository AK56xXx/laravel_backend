<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stageController extends Controller
{
    public function index()
    {
        return Stage::all();
    }

    public function stagesByState(int $etat)
    {
        $stages = DB::table('stages')->where('accepted', $etat)->get();
        return response()->json($stages, 200);
        
    }

    public function show(Stage $stage)
    {
        return $stage;
    }

    public function store(Request $request)
    {
      /*  $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$stage = Stage::create($request->all());

        return response()->json($stage, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
        }*/

        $demandes = DB::table('stages')
        ->where('mail',$request->input('mail'))
        ->where('accepted', '0')
        ->count();
        if($demandes==0){
            $user = $request->user();
            
            $stage = Stage::create($request->all());

            return response()->json($stage, 201);
        }else{
            return response()->json("previous demand not answered yet, you can not send new demands", 403);
        }
    }

    public function update(Request $request, Stage $stage)
    {
        $stage->update($request->all());

        return response()->json($stage, 200);
    }

    public function delete(Stage $stage)
    {
        $stage->delete();

        return response()->json(null, 204);
    }
}


