<?php

namespace Logger;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    public array $writters = [];
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

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        foreach ($this->writters as $writter) {
                $writter->write($level, $message, $context);
        }
    }
}