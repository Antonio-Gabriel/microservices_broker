<?php

namespace Candidates\domain\exceptions;

class CategoryAlreadyExists
{
    public function __construct(public string $message)
    {
    }
}
