<?php
/**
 * Created by PhpStorm.
 * User: 14k
 * Date: 2018/12/7 0007
 * Time: 0:31
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;

class AuthTwitterController extends Controller
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
        return Socialite::driver('twitter')->with(['slaughter'=>'dr_14k@yeah.net'])->redirect();
    }
}
