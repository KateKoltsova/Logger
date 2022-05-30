<?php

namespace Logger;

use Psr\Log\AbstractLogger;

/**
 * Main class of Logging.
 * Extends Abstract class from PSR.
 * Specifies the level and necessary information to write to a user-specified storage.
 */
class Logger extends AbstractLogger
{
    /**
     * Consist class of storage for writing.
     * @var array
     */
    public array $writters = [];

    /**
     * Gets array of WritterInterface to write logs
     * @param array $storage
     */
    public function __construct(array $writters)
    {
        foreach ($writters as $writter) {
            $this->writters[] = $writter;
        }
    }

    /**
     * Writing logs with write-function writer-classes.
     * @param $level
     * @param \Stringable|string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        foreach ($this->writters as $writter) {
            $writter->write($level, $message, $context);
        }
    }
}