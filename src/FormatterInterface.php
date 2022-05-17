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
     * @param $context
     * @return mixed
     */
    public function format(&$logInfo, $level, $message, $context = []);
}