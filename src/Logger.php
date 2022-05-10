<?php

namespace Logger;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $writter = new Writter($level, $message, $context);
        $writter->writeDB();
        $writter->writeFile();
    }
}