<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
        \App\Exceptions\Custom::class,
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

        //HTTP异常
        // if ($exception instanceof HttpException) {

        //     if($request->ajax()){ 

        //         return json(200, $exception->getMessage());
        //     }else{

        //         switch ($exception->getStatusCode()) {

        //            case 403:
        //                 return redirect('index/serverDenied');
        //                break;
        //            case 404:
        //                 return redirect('index/notFound');
        //                break;
        //            case 500:
        //                 return redirect('index/serverError');
        //                break;
        //         }
        //     }
        // }
        
        //模型未找到异常
        if ($exception instanceof ModelNotFoundException) {

            if($request->ajax()){ 

                return json(200, $exception->getMessage());
            }else{

                echo 11111;die;
                return redirect('index/notFound');
            }
        }

        //验证异常
        if ($exception instanceof ValidationException) {

            if($request->ajax()){ 

                return json(419, $exception->validator->errors()->first());
            }
        }

        //自定义异常
        if ($exception instanceof Custom) {

            if($request->ajax()){ 

                return json(500, $exception->getMessage());
            }
        }

        return parent::render($request, $exception);
    }
}
