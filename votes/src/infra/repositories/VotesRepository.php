<?php

namespace Votes\infra\repositories;

use Votes\domain\Voter;
use Votes\application\repositories\IVotesRepository;

class VotesRepository implements IVotesRepository
{
    private array $votes;

    public function __construct()
    {
        $this->votes = [];
    }

    public function addNewVote(Voter $voter)
    {
        array_push($this->votes, [
            "id"            => $voter->getId(),
            "voter"         => $voter->props->voter,
            "voterEmail"    => $voter->props->voterEmail,
            "candidateId"   => $voter->props->candidateId,
            "candidateName" => $voter->props->candidateName,
        ]);
    }

    public function findByVotedCandidate(string $candidateId, string $voterEmail)
    {
        return array_filter(
            $this->votes,
            fn ($vote) =>
            $vote["candidateId"] === $candidateId && $vote["voterEmail"] === $voterEmail
        );
    }
}
