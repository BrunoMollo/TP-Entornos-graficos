<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        $exceptionClass= get_class($exception);
        // echo $exceptionClass;
        if ($exceptionClass === 'Spatie\Permission\Exceptions\UnauthorizedException') {
            return response()->view('Error.403', [], 403);
        }else if($exceptionClass ==='Symfony\Component\HttpKernel\Exception\NotFoundHttpException' ){
            return response()->view('Error.404', [], 404);

        }
        return parent::render($request, $exception);
    }
}
