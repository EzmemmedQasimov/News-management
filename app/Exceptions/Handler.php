<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ValidationException) {
            Log::error("Validation Exception: " . $exception->getMessage());
            return error(Response::HTTP_UNPROCESSABLE_ENTITY, "Daxil edilən məlumatlar tam deyil.", $exception->errors());
        }

        if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
            Log::error("NotFound Exception: " . $exception->getMessage());
            return error(Response::HTTP_NOT_FOUND, "Məlumat tapılmadı.", $exception->getMessage());
        }

        if ($exception instanceof AuthenticationException) {
            Log::error("Authentication Exception: " . $exception->getMessage());
            return error(Response::HTTP_UNAUTHORIZED, "Not authenticated.", $exception->getMessage());
        }

        if ($exception instanceof Exception) {
            Log::error("Internal Server Exception: " . $exception->getMessage());
            return error(Response::HTTP_INTERNAL_SERVER_ERROR, "Server xətası.", $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
