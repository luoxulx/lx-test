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
        $params['email'] = $request->post('email');
        $params['password'] = $request->post('password');

        if ($token = Auth::guard('api')->attempt($params)) {
            return response()->json(['token'=>$token]);
        }else {
            return response()->json(['message'=>'error']);
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message'=>'logout']);
    }

}
