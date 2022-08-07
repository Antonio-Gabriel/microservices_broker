<?php

namespace Candidates\application\usecases;

use Candidates\common\Log;
use Candidates\domain\Candidates;
use Candidates\domain\types\CandidatesProps;
use Candidates\domain\exceptions\CandidateAlreadyExists;
use Candidates\application\repositories\ICandidatesRepository;

class CreateCandidate
{
    public function __construct(
        private ICandidatesRepository $candidatesRepository
    ) {
    }

    public function execute(string $name, string $categoryId)
    {
        $candidateAlreadyExists = $this->candidatesRepository->findCandidateByCategory(
            $name,
            $categoryId
        );

        if ($candidateAlreadyExists) {
            Log::set("Candidate [{$name}] already exists!", "error", [
                "name"          => $name,
                "categoryId"    => $categoryId
            ]);

            return new CandidateAlreadyExists("Candidate [{$name}] already exists!");
        }

        $candidate = Candidates::create(new CandidatesProps($name, $categoryId));

        if ($candidate->errorValue()) {
            return $candidate;
        }

        $this->candidatesRepository->create($candidate->getValue());
    }
}
