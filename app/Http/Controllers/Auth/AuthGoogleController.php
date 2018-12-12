<?php
/**
 * Created by PhpStorm.
 * User: 14k
 * Date: 2018/12/7 0007
 * Time: 0:27
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;

class AuthGoogleController extends Controller
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->with(['Frankenstein'=>'dr_14k@yeah.net'])->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        return response()->json($googleUser);
    }

    public function privacyPolicyView()
    {
        return view('auth.privacy.google');
    }
}
