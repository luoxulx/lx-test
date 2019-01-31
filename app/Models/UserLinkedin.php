<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserLinkedin
 *
 * @property int $id id
 * @property int $user_id user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLinkedin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLinkedin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLinkedin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLinkedin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserLinkedin whereUserId($value)
 * @mixin \Eloquent
 */
class UserLinkedin extends Model
{

    protected $table = 'user_linkedin';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
