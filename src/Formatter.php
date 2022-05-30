<?php

namespace Logger;

/**
 * Class for formatting received logs information.
 */
class Formatter implements FormatterInterface
{
    /**
     * Main function for formatting.
     * @param $logInfo
     * @param $level
     * @param $message
     * @param $context
     * @return void
     */
    public function format(&$logInfo, $level, $message, array $context = [])
    {
        $date = new \DateTime('now');
        $logInfo['date'] = $date->format('Y.m.d');
        $logInfo['time'] = $date->format('H:i:s');
        $logInfo['level'] = $level;
        $logInfo['message'] = $message;
        foreach ($context as $item) {
            $logInfo['context'] = $logInfo['context'] . serialize($item);
        }
    }
}