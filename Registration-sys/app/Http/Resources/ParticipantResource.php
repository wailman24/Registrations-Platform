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
        $u = DB::table('users')->where('id', $this->user_id)->first();
        return [
            'name' => $this->pname,
            'email' => $this->pemail,
            //'Team number' => $this->teamNum,
            'user' => $u->name
        ];
    }
}
