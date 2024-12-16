<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['Tname', 'TNum'];

    public function participant()
    {
        return $this->hasMany(participant::class);
    }
}
