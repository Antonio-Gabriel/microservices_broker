<?php

require_once __DIR__ . "/vendor/autoload.php";


use Votes\infra\messaging\kafka\KafkaConsumer;

$consumer = new KafkaConsumer();

$consumer->watch();
