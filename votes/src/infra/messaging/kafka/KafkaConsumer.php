<?php

namespace Votes\infra\messaging\kafka;

use Kafka\Consumer;
use Kafka\ConsumerConfig;
use Votes\application\usecases\VoteUseCase;
use Votes\infra\repositories\VotesRepository;

class KafkaConsumer
{
    private ConsumerConfig $config;
    private VotesRepository $votesRepository;

    public function __construct()
    {
        $this->config = ConsumerConfig::getInstance();
        $this->config->setMetadataRefreshIntervalMs(10000);
        $this->config->setMetadataBrokerList('localhost:9092');
        $this->config->setGroupId('votes');
        $this->config->setBrokerVersion('1.0.0');
        $this->config->setTopics(['candidate.new_vote']);

        $this->votesRepository = new VotesRepository();
    }

    public function watch()
    {
        $consumer = new Consumer();

        while (true) {
            $consumer->start(function ($topic, $part, $message) {
                $data = json_decode($message["message"]["value"]);

                $voteUseCase = new VoteUseCase($this->votesRepository);

                try {
                    $result = $voteUseCase->execute(
                        $data->voter,
                        $data->voterEmail,
                        $data->candidateName,
                        $data->candidateId
                    );

                    echo $result;
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            });
        }
    }
}
