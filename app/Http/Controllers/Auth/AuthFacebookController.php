<?php

/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/5
 * Time: 23:42
 */

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;

class AuthFacebookController extends Controller
{
	
	protected $user;

	public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

     /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
    	return 1;
    }

}