<?php

namespace Candidates\application\usecases;

use Candidates\application\repositories\ICandidatesRepository;

class ListCandidatesUseCase
{
    public function __construct(
        private ICandidatesRepository $candidatesRepository
    ) {
    }

    public function execute()
    {
        return $this->candidatesRepository->list();
    }
}
