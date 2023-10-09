<?php

namespace App\Exceptions;

use App\Enums\ErrorCode;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Exception;

class DuplicateUserException extends Exception
{
    private $errorCode;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $error = ErrorCode::DUPLICATE_USER_EXCEPTION;
        $this->errorCode = $error->errorCode();
        parent::__construct($error->message(), Response::HTTP_CONFLICT, $previous);
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

}
