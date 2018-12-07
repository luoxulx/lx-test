<?php
/**
 * Created by PhpStorm.
 * User: 14k
 * Date: 2018/12/7 0007
 * Time: 0:31
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthTwitterController
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->with(['slaughter'=>'dr_14k@yeah.net'])->redirect();
    }
}
