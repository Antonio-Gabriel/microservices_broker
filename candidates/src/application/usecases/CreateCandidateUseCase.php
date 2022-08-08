<?php

namespace Candidates\application\usecases;

use Candidates\common\Log;
use Candidates\domain\Candidates;
use Candidates\domain\types\CandidatesProps;
use Candidates\domain\exceptions\CandidateAlreadyExists;
use Candidates\application\repositories\ICandidatesRepository;

class CreateCandidateUseCase
{
    public function __construct(
        private ICandidatesRepository $candidatesRepository
    ) {
    }

    public function execute(string $name, string $categoryId)
    {
        $candidate = Candidates::create(new CandidatesProps($name, $categoryId));

        if ($error = $candidate->errorValue()) {
            throw new \Exception($error);
        }

        $candidateAlreadyExists = $this->candidatesRepository->findCandidateByCategory(
            $name,
            $categoryId
        );

        if ($candidateAlreadyExists) {
            Log::set("Candidate [{$name}] already exists!", "error", [
                "name"          => $name,
                "categoryId"    => $categoryId
            ]);

            throw new CandidateAlreadyExists("Candidate [{$name}] already exists!");
        }

        $result = $this->candidatesRepository->create($candidate->getValue());

        return $result;
    }
}
