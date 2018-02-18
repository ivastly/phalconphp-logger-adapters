<?php

namespace PhalconLogAdapters\Logging\Adapters;

use PhalconLogAdapters\Logging\Formatters\DummyFormatter;
use Phalcon\Logger;
use Phalcon\Logger\Adapter;
use Phalcon\Logger\AdapterInterface;

abstract class AbstractAdapter extends Adapter implements AdapterInterface
{
     const LOG_LEVEL_TO_STRING = [

        Logger::ALERT => 'alert',
        Logger::CRITICAL => 'critical',
        Logger::CUSTOM => 'custom',
        Logger::DEBUG => 'debug',
        Logger::EMERGENCE => 'emergence',
        Logger::EMERGENCY => 'emergency',
        Logger::ERROR => 'error',
        Logger::INFO => 'info',
        Logger::NOTICE => 'notice',
        Logger::SPECIAL => 'special',
        Logger::WARNING => 'warning',

    ];

    /**
     * @inheritdoc
     */
    public function getFormatter()
    {
        return new DummyFormatter();
    }

    /**
     * @inheritdoc
     */
    public function close()
    {
        return true;
    }

     /**
     * main logic of adapter is here
     *
     * @param string $message
     * @param int    $type
     * @param int    $time
     * @param array  $context
     *
     * @throws \Exception
     */
    abstract public function loginternal($message, $type, $time, $context);
}
