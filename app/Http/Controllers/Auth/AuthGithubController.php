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
        return Socialite::driver('github')->with(['Frankenstein'=>'dr_14k@yeah.net'])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        return response()->json(['aaa'=>$githubUser]);

        $user = $this->user->getUserBygithubId($github_user_info['github_id']);

        if (auth()->check()) {
            $currentUser = auth()->user();

            if ($currentUser->github_id === 0) {
                if ($user) {
                    return redirect()->back();
                }
                $this->bindToGithub($currentUser, $github_user_info);
            }

            return redirect()->back();
        }else {
            if ($user) {
                auth()->loginUsingId($user->id);
                return redirect()->to('/');
            }
            $this->registerByGithubInfo($github_user_info);
        }
    }

    protected function bindToGithub($currentUser, array $github_user_info)
    {
        $currentUser->github_id = $github_user_info['github_id'];
        $currentUser->save();

        return redirect()->back();
    }

    protected function registerByGithubInfo(array $github_user_info)
    {
        return redirect()->to('/');
    }

    public function privacyPolicyView()
    {
        return view('auth.privacy.github');
    }
}
