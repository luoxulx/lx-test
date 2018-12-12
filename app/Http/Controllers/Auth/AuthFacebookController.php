<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/12
 * Time: 下午8:17
 */

namespace App\Http\Controllers\Auth;


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
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->with(['Frankenstein'=>'dr_14k@yeah.net'])->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        return response()->json(['as'=>$facebookUser]);
    }

    public function privacyPolicyView()
    {
        return view('auth.privacy.facebook');
    }
}
