<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParticipantResource;
use App\Models\participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\TeamResource;
use App\Models\Team;

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
    public function store(Request $request)
    {

        try {
            $user = Auth::user(); //get the authenticated user's info

            $exist = DB::table('participants')->where('user_id', $user->id)->exists();
            if ($exist) {
                return response()->json([
                    'message' => 'you already a participant'
                ]);
            }

            //check ig user is a TL "team leader"
            if ($user->role_id != NULL) {
                $role_u = DB::table('roles')->where('id', $user->role_id)->first();
                if ($role_u->Rname == 'TL') {

                    $request->validate([
                        'Tname' => 'required|unique:teams,Tname',
                    ]);
                    do {
                        $teamNumber = mt_rand(100000, 999999);
                        $exist = DB::table('teams')->where('TNum', $teamNumber)->exists();
                    } while ($exist);
                    $team = Team::create([
                        'Tname' => $request->Tname,
                        'TNum' => $teamNumber
                    ]);

                    $t_id = DB::table('teams')->where('TNum', $teamNumber)->first();

                    $partc = participant::create([
                        'pname' => $user->name,
                        'pemail' => $user->email,
                        'isTL' => true,
                        'team_id' => $t_id->id,
                        'user_id' => $user->id
                    ]);
                    return new ParticipantResource($partc);
                }
            } else { //here creat a simple participant

                $request->validate([
                    'teamNum' => 'required|exists:teams,TNum'
                ]);
                $t_id = DB::table('teams')->where('TNum', $request->teamNum)->first();

                $partc = participant::create([
                    'pname' => $user->name,
                    'pemail' => $user->email,
                    'isTL' => false,
                    'team_id' => $t_id->id,
                    'user_id' => $user->id
                ]);
                return new ParticipantResource($partc);
            }
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
