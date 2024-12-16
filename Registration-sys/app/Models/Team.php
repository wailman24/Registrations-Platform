<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['Tname', 'TNum'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
