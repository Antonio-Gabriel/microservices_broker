<?php

namespace Candidates\application\repositories;

use Candidates\domain\Candidates;

interface ICandidatesRepository
{
    public function create(Candidates $candidate);
    public function findCandidateByCategory(string $name, string $categoryId);
}
