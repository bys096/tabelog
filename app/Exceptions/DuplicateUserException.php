<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;


class DuplicateUserException extends RuntimeException implements Responsable
{
    protected $error = 'Duplicate User Exception';
    private $factory;
    protected $code;

    public function __construct(
        View $factory,
        string $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        $this->factory = $factory;
        $this->code = $code;
        parent::__construct($message, $code, $previous);
    }

    public function toResponse($request): Response
    {
        return new Response(
//            $this->factory->with($this->error, $this->message)
            $this->factory->with([
                'error' => $this->error,
                'message' => $this->message,
                'code' => $this->code
            ])
        );

    }
}
