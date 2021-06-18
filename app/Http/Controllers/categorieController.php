<?php

namespace App\Http\Controllers;
use App\Models\Categorie;

use Illuminate\Http\Request;

class categorieController extends Controller
{
    public function index()
    {
        return Categorie::all();
    }

    public function show(Categorie $categorie)
    {
        return $categorie;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$categorie = Categorie::create($request->all());

        return response()->json($categorie, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
        }
    }

    public function update(Request $request, Categorie $categorie)
    {
        $categorie->update($request->all());

        return response()->json($categorie, 200);
    }

    public function delete(Categorie $categorie)
    {
        $categorie->delete();

        return response()->json(null, 204);
    }
}
