<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class documentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function show(Document $document)
    {
        return $document;
    }

    public function store(Request $request)
    {
        $user = $request->user();
      //  if($user->tokenCan('admin_privilege'))
        {$document = Document::create($request->all());

        return response()->json($document, 201);}
      //  else{
        //    return response()->json('unauthorized modification, you do not have access',403);
      //  }
    }

    public function update(Request $request, Document $document)
    {
        $document->update($request->all());

        return response()->json($document, 200);
    }

    public function delete(Document $document)
    {
        $document->delete();

        return response()->json(null, 204);
    }
}
