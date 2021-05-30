<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class meetingController extends Controller
{
    public function index()
    {
        return Meeting::all();
    }

    public function show(Meeting $meeting)
    {
        return $meeting;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user->tokenCan('admin_privilege'))
        {$meeting = Meeting::create($request->all());

        return response()->json($meeting, 201);}
        else{
            return response()->json('unauthorized modification, you do not have access',403);
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


