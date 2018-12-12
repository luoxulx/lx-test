<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserGithub extends Model
{

    protected $table = 'user_github';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
