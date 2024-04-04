<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionStor;
use App\Http\Requests\SessionStorRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::where('user_id', Auth::id())->get();
        // dd($sessions);
        if (count($sessions) == 0) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }

        return response()->json([
            'sessions' => $sessions,
        ], 200);
    }


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionStorRequest $request)
    {
        //
        $validation = $request->validated();
        $validation['user_id'] = auth()->id();

        // dd($validation);
        $session = session::create($validation);
        if ($session) {
            return response()->json([
                'message' => 'session created successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'erorr'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SessionUpdateRequest $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionUpdateRequest $request, $id)
    {
        //

        $session = Session::find($id);
        if (!$session) {
            return response()->json([
                'message' => 'Session not found'
            ], 404);
        }
        $validation = $request->validated();
        // dd($validation);
        $session->update($validation);
        if ($session) {
            return response()->json([
                'message' => 'session updated successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'erorr'
            ], 500);
        }

    }

    public function status(Session $session)
    {
        if($session->status == 'terminer'){
            return response()->json([
                'message' => 'the session has finished'
            ],200);
        }else{
            $session->update([
                'status'=> 'terminer'
            ]);
            return response()->json([
                'message' => 'the session status is updated'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session, $id)
    {
        $session = Session::find($id);
        
        if (!$session) {
            return response()->json([
                'message' => 'Session not found'
            ], 404);
        }


        $session->delete();

        return response()->json([
            'message' => 'Session deleted successfully'
        ], 200);
    }
}
