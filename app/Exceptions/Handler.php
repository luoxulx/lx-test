<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
//        if ($request->hasHeader('authorization') === true) {
//
//            return response()->json([
//                'message' => $exception->getMessage(),
//                'code' => $exception->getCode(),
//                'debug' => config('app.debug') === true ? ['file' => $exception->getFile(),'line' => $exception->getLine(),'trace' => $exception->getTrace()] : null
//            ], 500);
//        }
//        return parent::render($request, $exception);
        return response()->json([
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'debug' => ['file' => $exception->getFile(),'line' => $exception->getLine(),'trace' => $exception->getTrace()]
        ], 500);
    }
}
