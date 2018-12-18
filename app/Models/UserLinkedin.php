<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserLinkedin extends Model
{

    protected $table = 'user_linkedin';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
