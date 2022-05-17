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
     * Determines the name of the called class from the type of storage.
     * Creates an object of this class and writes it to the writers array.
     * @param array $storage
     */
    public function __construct(array $storage)
    {
        foreach ($storage as $stor)
        {
            $className = "Logger\\$stor".'Writter';
            if (class_exists($className)) {
                $this->writters[] = new $className();
            } else {
                echo "Logger can`t writing to $stor!".PHP_EOL;
            }
        }
    }

    /**
     * Writing logs with write-function writer-classes.
     * @param $level
     * @param \Stringable|string $message
     * @param array $context
     * @return void
     */
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        foreach ($this->writters as $writter) {
                $writter->write($level, $message, $context);
        }
    }
}