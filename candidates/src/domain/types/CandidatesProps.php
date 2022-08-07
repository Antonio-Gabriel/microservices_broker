<?php

namespace Candidates\domain\types;

class CandidatesProps
{
    public function __construct(
        public string $name,
        public string $categoryId
    ) {
    }
}
