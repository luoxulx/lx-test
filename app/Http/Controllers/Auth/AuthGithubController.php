<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/5
 * Time: 23:39
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;

class AuthGithubController extends Controller
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

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = $this->user->getUserBygithubId($githubUser->id);

        dd($githubUser);die;

//        if (auth()->check()) {
//            $currentUser = auth()->user();
//
//            if ($currentUser->github_id) {
//                return redirect()->back();
//            } else {
//                if ($user) {
//                    return redirect()->back();
//                } else {
//                    $this->bindToGithub($currentUser, $githubUser);
//
//                    return redirect()->back();
//                }
//            }
//        } else {
//            if ($user) {
//                auth()->loginUsingId($user->id);
//                // article
//                return redirect()->to('/');
//            } else {
//                $this->registerByGithubInfo($githubUser);
//                return redirect()->to('auth/github/register');
//            }
//        }

    }

    protected function bindToGithub()
    {

    }

    protected function registerByGithubInfo()
    {

    }
}
