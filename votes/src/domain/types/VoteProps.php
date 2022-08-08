<?php

namespace Votes\domain\types;

class VoteProps
{
    public function __construct(
        public string $voter,
        public string $voterEmail,
        public string $candidateName,
        public string $candidateId
    ) {
    }
}
