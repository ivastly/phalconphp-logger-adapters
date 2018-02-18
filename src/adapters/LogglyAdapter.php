<?php

namespace App\Logging\Adapters;

use App\Services\External\LogglyClient;
use Phalcon\Logger;

class LogglyAdapter extends AbstractAdapter
{
    /** @var LogglyClient */
    private $client;

     /** @var int */
    private $sensitivityThreshold;

    public function __construct(LogglyClient $client, int $sensitivityThreshold = Logger::WARNING)
    {
        $this->client = $client;
        $this->sensitivityThreshold = $sensitivityThreshold;

    }

    /**
     * @inheritdoc
     */
    public function loginternal($message, $type, $time, $context)
    {
        if ($type <= $this->sensitivityThreshold) {
            $payload = ['message' => $message, 'context' => $context];

            $this->client->loggly(self::LOG_LEVEL_TO_STRING[$type], $payload);
        }
    }
}
