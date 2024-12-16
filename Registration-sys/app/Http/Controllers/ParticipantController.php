<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParticipantResource;
use App\Models\participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ParticipantResource::collection(participant::all());
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
    public function store()
    {

        try {
            $user = Auth::user();

            $partc = participant::create([
                'pname' => $user->name,
                'pemail' => $user->email,
                //'teamNum' => $request->teamNum,
                'user_id' => $user->id
            ]);
            return new ParticipantResource($partc);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(participant $participant)
    {
        return new ParticipantResource($participant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, participant $participant) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(participant $participant)
    {
        $participant->delete();
    }
}
