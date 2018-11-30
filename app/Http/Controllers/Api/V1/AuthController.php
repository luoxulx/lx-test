<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/19
 * Time: 上午12:10
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'http://cdn2.lnmpa.top/';


    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        Auth::guard('api')->logout();

        return $this->response->json(['message'=>'logout successful']);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendLoginResponse($request)
    {
        $param['email'] = $request->post('email');
        $param['password'] = $request->post('password');
        $token = Auth::guard('api')->attempt($param);

        if (! $token) {
            return $this->response->withUnauthorized('bearer token failed');
        }

        return $this->response->json(['token' => 'bearer ' . $token,'key'=>str_random(16)]);
    }

}
