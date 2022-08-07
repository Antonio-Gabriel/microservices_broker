<?php

namespace Candidates\domain\exceptions;

use Candidates\common\Result;

class CandidateAlreadyExists
{
    public function __construct(public string $message)
    {
        $this->message = Result::Fail($message);
    }
}
