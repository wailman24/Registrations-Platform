<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    public function participant()
    {
        return $this->hasOne(participant::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
