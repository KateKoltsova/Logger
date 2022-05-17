<?php

namespace Logger;

/**
 * Interface for Writer classes.
 */
interface WritterInterface
{
    public function __construct();

    /**
     * Main function.
     * @param $level
     * @param $message
     * @param $context
     * @return mixed
     */
    public function write($level, $message, $context);
}