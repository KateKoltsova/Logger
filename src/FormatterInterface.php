<?php

namespace Logger;

interface FormatterInterface
{
    public function format(&$logInfo, $level, $message, $context = []);
}