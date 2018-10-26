<?php
/**
 * 只记录  所有的api 接口,含jwt鉴权和开放的
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/22
 * Time: 01:22
 */

namespace App\Http\Middleware;

use App\Models\OperationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class LogOperation extends BaseMiddleware
{


    public function handle($request, \Closure $next)
    {
        if ($this->shouldLogOperation($request)) {
            $log = array(
                // 'user_id' => Admin::user()->id,
                'user_id' => 1,
                'path'    => substr($request->path(), 0, 255),
                'method'  => $request->method(),
                'ip'      => $request->getClientIp(),
                'request'   => json_encode(['header'=>$request->headers->all(), 'body'=>$request->input()]),
                'jwt_auth' => $request->hasHeader('Authorization') ? 1 : 0
            );

            try {
                OperationLog::create($log);
            } catch (\Exception $exception) {
                // pass
            }
        }

        return $next($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function shouldLogOperation(Request $request)
    {
//        return config('my.operation_log.enable')
//            && !$this->inExceptArray($request)
//            && $this->inAllowedMethods($request->method())
//            && Admin::user();
        return config('my.operation_log.enable')
            && !$this->inExceptArray($request)
            && $this->inAllowedMethods($request->method());
    }

    /**
     * Whether requests using this method are allowed to be logged.
     *
     * @param string $method
     *
     * @return bool
     */
    protected function inAllowedMethods($method)
    {
        $allowedMethods = collect(config('my.operation_log.allowed_methods'))->filter();

        if ($allowedMethods->isEmpty()) {
            return true;
        }

        return $allowedMethods->map(function ($method) {
            return strtoupper($method);
        })->contains($method);
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach (config('my.operation_log.except') as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            $methods = [];

            if (Str::contains($except, ':')) {
                list($methods, $except) = explode(':', $except);
                $methods = explode(',', $methods);
            }

            $methods = array_map('strtoupper', $methods);

            if ($request->is($except) &&
                (empty($methods) || in_array($request->method(), $methods))) {
                return true;
            }
        }

        return false;
    }
}
