<?php

namespace Logger;

class Formatter implements FormatterInterface
{
    public function format(&$logInfo, $level, $message, $context = [])
    {
        $date = new \DateTime('now');
        $logInfo['date'] = $date->format('Y.m.d');
        $logInfo['time'] = $date->format('H:i:s');
        $logInfo['level'] = $level;
        $logInfo['message'] = $message;
        $logInfo['context'] = implode(', ', $context);
    }
}