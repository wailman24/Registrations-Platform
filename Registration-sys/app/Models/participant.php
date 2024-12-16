<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class participant extends Model
{
    protected $fillable = ['user_id', 'pname', 'pemail'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
