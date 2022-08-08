<?php

namespace Votes\application\repositories;

use Votes\domain\Voter;

interface IVotesRepository
{
    public function addNewVote(Voter $voter);

    public function findByVotedCandidate(string $candidateId, string $voterEmail);
}
