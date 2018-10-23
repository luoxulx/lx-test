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

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        // return response()->json(['test'=>$request]);
        $params['email'] = $request->post('email');
        if (trim($params['email']) == '') {
            return response()->json(['message'=>'email is required !'], 400);
        }

        $params['password'] = $request->post('password');
        if (trim($params['password']) == '') {
            return response()->json(['message'=>'password is required !'], 400);
        }

        if ($token = Auth::guard('api')->attempt($params)) {
            return response()->json(['dgo_token'=>'Bearer '.$token, 'csrf_token'=>csrf_token() === null ? str_random() : csrf_token()]);
        }else {
            return response()->json(['message'=>'email or password is incorrect'], 401);
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message'=>'logout successful']);
    }

}
