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

        if (! $request->header('Access-key')) {
            return response()->json(['message' => 'Illegal Request！Access-key Error！'], 401);
        }
        return $next($request);
    }
}
