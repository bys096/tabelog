<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

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

    public function render($request, Throwable $e)
    {
//        jsonで要請が入り、Eloquent　Queryで検索されるデータがなかったらエラーを返します。
        if ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'message' => 'Resource not found',
                'error_code' => 'M001'
            ], 400);
        }

        if ($e instanceof DuplicateUserException) {
            return response()->json([
                'status' => $e->getCode(),
                'error_code' => $e->getErrorCode(),
                'message' => $e->getMessage()
            ]);
        }

        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }

    public function report(Throwable $e)
    {
        if ($e instanceof DuplicateUserException) {
            Log::error('Exception Occured - code: ' . $e->getCode());
            Log::error('Exception Occured - message: ' . $e->getMessage());
        }
    }

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
