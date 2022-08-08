<?php

namespace Votes\application\usecases;

use Votes\domain\Voter;
use Votes\domain\types\VoteProps;
use Votes\domain\exceptions\CandidateAlreadyVoted;
use Votes\application\repositories\IVotesRepository;

class VoteUseCase
{
    public function __construct(
        private IVotesRepository $votesRepository
    ) {
    }

    public function execute(string $voter, string $voterEmail, string $candidateName, string $candidateId): string
    {
        $voterEntity = Voter::create(new VoteProps($voter, $voterEmail, $candidateName, $candidateId));

        if ($error = $voterEntity->errorValue()) {
            throw new \Exception($error);
        }

        $candidateAlreadyVoted = $this->votesRepository->findByVotedCandidate($candidateId, $voterEmail);

        if ($candidateAlreadyVoted) {
            throw new CandidateAlreadyVoted("Candidate already voted to you!\n\n");
        }

        $this->votesRepository->addNewVote($voterEntity->getValue());

        return "The {$voter}, voted to {$candidateName}! \n\n";
    }
}
