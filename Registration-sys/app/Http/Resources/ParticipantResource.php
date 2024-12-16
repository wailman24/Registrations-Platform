<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $team = DB::table('teams')->where('id', $this->team_id)->first();
        $u = DB::table('users')->where('id', $this->user_id)->first();
        return [
            'name' => $this->pname,
            'email' => $this->pemail,
            'Team number' => $team->TNum,
            'user' => $u->name
        ];
    }
}
