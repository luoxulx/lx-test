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
            $this->response->setStatusCode(201);
            return $this->response->json(['token' => 'bearer '.$token , 'Access-Key' => str_random()], ['Authorization' => 'bearer '.$token]);
        }

        $this->response->setStatusCode(401);
        return $this->response->json(['message' => 'Refused to login！']);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->response->json(['message'=>'out successful！']);
    }

}
