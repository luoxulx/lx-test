<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTwitter
 *
 * @property int $id id
 * @property int $user_id user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTwitter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTwitter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTwitter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTwitter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTwitter whereUserId($value)
 * @mixin \Eloquent
 */
class UserTwitter extends Model
{

    protected $table = 'user_twitter';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
