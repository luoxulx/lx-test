<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/6
 * Time: 下午8:24
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class OpenApi
{

    public function handle(Request $request, \Closure $next)
    {

        if (! $request->header('Access-Key')) {
            return response()->json(['message' => 'Illegal Request！Access-Key Error！'], 401);
        }
        return $next($request);
    }
}
