<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$visit = Visit::create($request->all());

        return response()->json($visit, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
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


