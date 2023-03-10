<?php

class BaseException extends Exception
{
    public function __construct(string $message = "Internal server error", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}