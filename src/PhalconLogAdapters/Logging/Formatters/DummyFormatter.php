<?php

namespace PhalconLogAdapters\Logging\Formatters;

use Phalcon\Logger\Formatter;
use Phalcon\Logger\FormatterInterface;

class DummyFormatter extends Formatter implements FormatterInterface
{
    /**
     * Applies a format to a message before sent it to the internal log
     *
     * @param string $message
     * @param int    $type
     * @param int    $timestamp
     * @param mixed  $context
     *
     * @return string|array
     */
    public function format($message, $type, $timestamp, $context = null)
    {
        // empty on purpose
    }
}
