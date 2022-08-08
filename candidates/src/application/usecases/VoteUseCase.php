<?php

namespace Candidates\application\usecases;

use Candidates\common\Log;
use Candidates\domain\exceptions\CandidateDoNotExists;
use Candidates\application\repositories\ICandidatesRepository;

use Candidates\infra\messaging\kafka\KafkaProducer;

use Exception;

class VoteUseCase
{
    private KafkaProducer $producer;

    public function __construct(
        private ICandidatesRepository $candidatesRepository
    ) {
        $this->producer = new KafkaProducer();
    }

    public function execute(string $candidateId, string $voter, string $voterEmail)
    {
        $candidate = $this->candidatesRepository->findByCandidateId($candidateId);

        if (!$candidate) {
            Log::set("Candidate doesn't exists!", "error", [
                "candidateId" => $candidateId
            ]);

            throw new CandidateDoNotExists("Candidate doesn't exists!");
        }

        if (empty($voter) || empty($voterEmail)) {
            throw new Exception("Check the input data");
        }

        $this->producer->send([
            'topic' => 'candidate.new_vote',
            'value' =>  json_encode([
                'voter'          =>  $voter,
                'voterEmail'     =>  $voterEmail,
                'candidateId'    =>  $candidate->getId(),
                'candidateName'  =>  $candidate->getName(),
            ]),
            'key' => 'candidate.new_vote_key',
        ]);
    }
}
