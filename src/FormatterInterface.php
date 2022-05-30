<?php

namespace Logger;

/**
 * Interface for Formatter classes.
 */
interface FormatterInterface
{
    /**
     * Main function.
     * @param $logInfo
     * @param $level
     * @param $message
     * @param array $context
     * @return mixed
     */
    public function format(&$logInfo, $level, $message, array $context = []);
}