<?php

namespace App\Http\Controllers;
use App\Models\Evenement;
use Illuminate\Http\Request;

class eventController extends Controller
{
    public function index()
    {
        return Evenement::all();
    }

    public function show(Evenement $event)
    {
        return $event;
    }

    public function store(Request $request)
    {
        $user = $request->user();
     //   if($user->tokenCan('admin_privilege'))
        {$event = Evenement::create($request->all());

        return response()->json($event, 201);}
     //   else{
         //   return response()->json('unauthorized modification, you do not have access',403);
      //  }
    }

    public function update(Request $request, Evenement $event)
    {
        $event->update($request->all());

        return response()->json($event, 200);
    }

    public function delete(Evenement $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }
}
