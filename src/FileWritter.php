<?php

namespace Logger;

class FileWritter implements WritterInterface
{
    public Formatter $formatter;

    public array $logInfo = [
        'date' => '',
        'time' => '',
        'level' => '',
        'message' => '',
        'context' => ''
    ];
    public function __construct()
    {
        $this->formatter = new Formatter();
    }

    public function write($level, $message, $context)
    {
        $this->formatter->format($this->logInfo, $level, $message, $context);
        $fileName = 'loggs.txt';
        $fileLogs = fopen($fileName, 'a');
        fwrite($fileLogs, implode("\t|\t", $this->logInfo) . PHP_EOL);
        fclose($fileLogs);
        echo 'Writing to File success!'.PHP_EOL;
    }
}