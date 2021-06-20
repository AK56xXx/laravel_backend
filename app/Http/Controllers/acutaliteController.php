<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class actualiteController extends Controller
{
    public function index()
    {
        $actualites =Actualite::all(); 
        return response()->json($actualites, 200);
    }

    public function show(Actualite $actualite)
    {
        return $actualite;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$actualite = Actualite::create($request->all());

        return response()->json($actualite, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
        }
    }

    public function update(Request $request, Actualite $actualite)
    {
        $actualite->update($request->all());

        return response()->json($actualite, 200);
    }

    public function delete(Actualite $actualite)
    {
        $actualite->delete();

        return response()->json(null, 204);
    }
}


