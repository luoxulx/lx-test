<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserGoogle
 *
 * @property int $id id
 * @property int $user_id user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGoogle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGoogle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGoogle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGoogle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGoogle whereUserId($value)
 * @mixin \Eloquent
 */
class UserGoogle extends Model
{

    protected $table = 'user_google';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
