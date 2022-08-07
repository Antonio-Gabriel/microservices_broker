<?php

namespace Candidates\common;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

abstract class Log
{
    private static function logBaseConfIni()
    {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . "storage" .
            DIRECTORY_SEPARATOR . "logs" . DIRECTORY_SEPARATOR;

        $logger = new Logger("LOG");
        $logger->pushHandler(new StreamHandler($path . "logs.log"));

        return $logger;
    }

    public static function set(string $message, ?string $type = null, array $context = [])
    {
        $logger = self::logBaseConfIni();

        match ($type) {
            "error"     => $logger->error($message, $context),
            "warning"   => $logger->warning($message, $context),
            "debug"     => $logger->debug($message, $context),
            default     => $logger->info($message, $context)
        };
    }
}
