<?php

class NotFoundException extends BaseException
{
    public function __construct(string $message = "Not found", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}