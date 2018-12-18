<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserFacebook extends Model
{

    protected $table = 'user_facebook';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
