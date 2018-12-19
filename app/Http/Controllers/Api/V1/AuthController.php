<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/19
 * Time: 上午12:10
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends ApiController
{

    // use  AuthenticatesUsers;

    protected $redirectTo = 'https://www.baidu.com/';

    public function login(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users'],
            'password' => 'required|string|min:6|max:16'
        ];

        $params = $this->validate($request, $rules);

        $token = Auth::guard('api')->attempt($params);

        if ($token) {
            $access_key = str_random(32);
            cache(['temp_access_key' => $access_key], 60);

            return $this->response
                ->json([
                    'message' => 'successful',
                    'token' => 'bearer '.$token,
                    'key' => $access_key
                    ]);
        }

        return $this->response
            ->setStatusCode(401)
            ->json(['message' => 'Refused to login！']);
    }

    public function refershToken()
    {
        $token = Auth::guard('api')->refresh();

        return $this->response->json(['token'=>$token]);
    }

    public function me()
    {
        return $this->response->json(['data'=>Auth::guard('api')->user()]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->response->json(['message'=>'out successful！']);
    }

}
