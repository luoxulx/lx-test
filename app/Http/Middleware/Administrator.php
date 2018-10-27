<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/27
 * Time: 20:04
 */

namespace App\Http\Middleware;


use Illuminate\Http\Request;

class Administrator
{

    public function handle(Request $request, \Closure $next)
    {

        return $next($request);
    }
}
