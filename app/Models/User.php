<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    # user info other table--------------------------------------------start

    public function githubInfo()
    {
        return $this->hasOne(UserGithub::class, 'user_id', 'id');
    }

    public function facebookInfo()
    {
        return $this->hasOne(UserFacebook::class, 'user_id', 'id');
    }

    public function googleInfo()
    {
        return $this->hasOne(UserGoogle::class, 'user_id', 'id');
    }

    public function linkedinInfo()
    {
        return $this->hasOne(UserLinkedin::class, 'user_id', 'id');
    }

    public function twitterInfo()
    {
        return $this->hasOne(UserTwitter::class, 'user_id', 'id');
    }

    # user info other table--------------------------------------------end

}
