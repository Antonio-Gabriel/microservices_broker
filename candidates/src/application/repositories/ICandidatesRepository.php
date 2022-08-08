<?php

namespace Candidates\application\repositories;

use Candidates\domain\Candidates;

interface ICandidatesRepository
{
    public function create(Candidates $candidate): string;

    public function findByCandidateId(string $candidateId);
    public function findCandidateByCategory(string $name, string $categoryId);

    public function list(): array;
}
