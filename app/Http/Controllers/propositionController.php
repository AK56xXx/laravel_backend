<?php

namespace App\Http\Controllers;

use App\Models\Proposition;
use Illuminate\Http\Request;

class propositionController extends Controller
{
    public function index()
    {
        return Proposition::all();
    }

    public function show(Proposition $proposition)
    {
        return $proposition;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$proposition = Proposition::create($request->all());

        return response()->json($proposition, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
        }
    }

    public function update(Request $request, Proposition $proposition)
    {
        $proposition->update($request->all());

        return response()->json($proposition, 200);
    }

    public function delete(Proposition $proposition)
    {
        $proposition->delete();

        return response()->json(null, 204);
    }
}


