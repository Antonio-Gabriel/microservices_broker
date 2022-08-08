<?php

namespace Candidates\infra\repositories;

use Candidate;
use CandidateQuery;

use Candidates\domain\Candidates;
use Candidates\application\repositories\ICandidatesRepository;

class CandidatesRepository implements ICandidatesRepository
{
    public function create(Candidates $candidate): string
    {
        $candidateSchema = new Candidate();
        $candidateSchema->setId($candidate->getId());
        $candidateSchema->setName($candidate->props->name);
        $candidateSchema->setCategoryId($candidate->props->categoryId);

        $candidateSchema->save();

        return $candidateSchema->getId();
    }


    public function findByCandidateId(string $candidateId)
    {
        return CandidateQuery::create()
            ->findOneById($candidateId);
    }

    public function findCandidateByCategory(string $name, string $categoryId)
    {
        return CandidateQuery::create()
            ->findOneByArray([
                "Name"        => $name,
                "CategoryId"  => $categoryId
            ]);
    }

    public function list(): array
    {
        $candidates = [];
        foreach (CandidateQuery::create()->find() as $value) {
            array_push($candidates, [
                "id"            =>  $value->getId(),
                "name"          =>  $value->getName(),
                "categoryId"    =>  $value->getCategoryId(),
            ]);
        }

        return $candidates;
    }
}
