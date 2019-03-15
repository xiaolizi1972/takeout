<?php

namespace App\Exceptions;

use Exception;

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
        App\Exceptions\CustomException::class,
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

       
        if ($exception instanceof NotFoundHttpException) {

            if($request->ajax()){ 

                return json(200, $exception->getMessage());
            }
        }

        if ($exception instanceof ModelNotFoundException) {

            if($request->ajax()){ 

                return json(200, $exception->getMessage());
            }
        }

        if ($exception instanceof ValidationException) {

            if($request->ajax()){ 

                return json(500, $exception->validator->errors()->first());
            }
        }

        if ($exception instanceof CustomException) {

            if($request->ajax()){ 

                return json(500, $exception->getMessage());
            }
        }

        return parent::render($request, $exception);
    }
}
