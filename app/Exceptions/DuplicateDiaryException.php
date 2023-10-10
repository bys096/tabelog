<?php

namespace App\Exceptions;

use App\Enums\ErrorCode;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class DuplicateDiaryException extends Exception
{

    private $errorCode;
    private $error;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->error = ErrorCode::DUPLICATE_USER_EXCEPTION;
        $this->errorCode = $this->error->errorCode();
        parent::__construct($this->error->message(), Response::HTTP_CONFLICT, $previous);
    }

}
