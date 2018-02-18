<?php

namespace PhalconLogAdapters\Logging\Adapters;

use PhalconLogAdapters\Services\External\TelegramClient;
use Phalcon\Logger;

class TelegramAdapter extends AbstractAdapter
{
    /** @var TelegramClient */
    private $client;

    /** @var int */
    private $sensitivityThreshold;

    public function __construct(TelegramClient $client, int $sensitivityThreshold = Logger::ALERT)
    {
        $this->client               = $client;
        $this->sensitivityThreshold = $sensitivityThreshold;
    }

    /**
     * @inheritdoc
     */
    public function loginternal($message, $type, $time, $context)
    {
        if ($type <= $this->sensitivityThreshold) {
            $this->client->sendTelegramMessage($message);
        }
    }
}
