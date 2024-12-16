<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class participant extends Model
{
    protected $fillable = ['user_id', 'pname', 'pemail', 'team_id',''];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
