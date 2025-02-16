<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if (config('app.debug')) {
            // Saat debug true, gunakan tampilan error bawaan Laravel
            return parent::render($request, $exception);
        } else {
            Log::error('Exception rendered: ' . $exception->getMessage());
    
            if ($this->isHttpException($exception)) {
                return response()->view('error.404');
            } else {
                return response()->view('error.500');
            }
        }
    }
}
