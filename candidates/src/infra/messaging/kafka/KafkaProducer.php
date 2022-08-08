<?php

namespace Candidates\infra\messaging\kafka;

use Kafka\Producer;
use Kafka\ProducerConfig;

class KafkaProducer
{
    private ProducerConfig $config;

    public function __construct()
    {
        $this->config = ProducerConfig::getInstance();
        $this->config->setMetadataRefreshIntervalMs(10000);
        $this->config->setMetadataBrokerList('localhost:9092');
        $this->config->setBrokerVersion('1.0.0');
        $this->config->setRequiredAck(1);
        $this->config->setIsAsyn(false);
        $this->config->setProduceInterval(500);
    }

    public function send(array $producerData)
    {
        $producer = new Producer(function () use ($producerData) {
            return [$producerData];
        });

        $producer->success(function ($result) {
            var_dump($result);
        });

        $producer->error(function ($errorCode) {
            var_dump($errorCode);
        });

        $producer->send(true);
    }
}
