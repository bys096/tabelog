<?php

namespace App\Exceptions;

use App\Enums\ErrorCode;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Exception;

class DuplicateUserException extends Exception implements Responsable
{
    private $errorCode;
    private $error;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->error = ErrorCode::DUPLICATE_USER_EXCEPTION;
        $this->errorCode = $this->error->errorCode();
        parent::__construct($this->error->message(), Response::HTTP_CONFLICT, $previous);
    }

//    toResponseオーバーライドし、応答を定義します。
    public function toResponse($request): Response
    {
        return response()->json([
            'code' => Response::HTTP_CONFLICT,              // HTTPコード
            'error_code' => $this->error->errorCode(),      // custom エラーコード
            'message' => $this->error->message(),           // error message
        ]);
    }
}
