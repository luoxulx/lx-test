<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserFacebook
 *
 * @property int $id id
 * @property int $user_id user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFacebook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFacebook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFacebook query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFacebook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserFacebook whereUserId($value)
 * @mixin \Eloquent
 */
class UserFacebook extends Model
{

    protected $table = 'user_facebook';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
