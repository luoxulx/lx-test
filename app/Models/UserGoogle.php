<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserGoogle extends Model
{

    protected $table = 'user_google';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
