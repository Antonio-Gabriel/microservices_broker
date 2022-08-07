<?php

namespace Candidates\domain\exceptions;

use Exception;

class CategoryAlreadyExistsException extends Exception
{
    public function __construct(string $message = "", int $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
