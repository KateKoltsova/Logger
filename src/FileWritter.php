<?php

namespace Logger;

/**
 * Class for writing logs to the file, implements WritterInterface.
 */
class FileWritter implements WritterInterface
{
    /**
     * @var FormatterInterface
     */
    public FormatterInterface $formatter;

    /**
     * Consist formatting log information.
     * @var array|string[]
     */
    public array $logInfo = [
        'date' => '',
        'time' => '',
        'level' => '',
        'message' => '',
        'context' => ''
    ];

    /**
     * With this function creating object of Formatter for using for formatting logs.
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Main function for writing formated logs info to the file.
     * @param $level
     * @param $message
     * @param $context
     * @return void
     */
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