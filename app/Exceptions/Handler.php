<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // 为了兼容 api 返回 json
        if($request->is('api/*')) {
            if ($exception instanceof ValidationException) {
                return response()->json(['message' => array_values($exception->errors())[0][0]], 422);
            }

            // 针对异常，返回json格式 处理
            $response = [];
            $http_code = $this->convertExceptionToResponse($exception)->getStatusCode();
            if ($http_code < 100 || $http_code >= 600) {
                return response()->json(['message' => 'HTTP ERROR'], $http_code);
            }

            $response['message'] = (!$exception->getMessage()) ? 'SOME ERRORS OCCURRED.' : $exception->getMessage();

            if (config('app.debug') === true) {
                $response['trace'] = $exception->getTraceAsString();
            }

            return response()->json($response, $http_code);
        } else {
            // 官方原版
            return parent::render($request, $exception);
        }
    }
}
