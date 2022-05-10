<?php

namespace Logger;

interface WritterInterface
{
    public function __construct();

    public function write($level, $message, $context);
}