<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class stageController extends Controller
{
    public function index()
    {
        return Stage::all();
    }

    public function show(Stage $stage)
    {
        return $stage;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$stage = Stage::create($request->all());

        return response()->json($stage, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
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


