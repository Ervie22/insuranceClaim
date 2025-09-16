<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // If session expired or CSRF token mismatch, redirect to login
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('login')
                ->with('message', 'Your session has expired. Please login again.');
        }

        return parent::render($request, $exception);
    }
}
