<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserTwitter extends Model
{

    protected $table = 'user_twitter';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
