<?php

namespace Logger;

class Writter
{
    public array $logInfo = [
        'date' => '',
        'time' => '',
        'level' => '',
        'message' => '',
        'context' => ''
    ];

    public function __construct($level, $message, $context)
    {
        Formatter::format($this->logInfo, $level, $message, $context);
    }

    public function writeDB()
    {
        $db = new DataBase();
        $dbc = $db->dbc;

        $sql = 'id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                Date date NOT NULL,
                Time time NOT NULL,
                Level varchar(255) NOT NULL,
                Message varchar(255) NOT NULL,
                Context varchar(255) NOT NULL';
        $db->createTable('Log', $sql);

        $log = $dbc->prepare('
            INSERT INTO Log (Date, Time, Level, Message, Context) 
            VALUES (:date,
                    :time,
                    :level,
                    :message,
                    :context)
        ');
        $log->bindValue(':date', $this->logInfo['date']);
        $log->bindValue(':time', $this->logInfo['time']);
        $log->bindValue(':level', $this->logInfo['level']);
        $log->bindValue(':message', $this->logInfo['message']);
        $log->bindValue(':context', $this->logInfo['context']);
        $log->execute();
    }

    public function writeFile()
    {
        $fileName = 'loggs.txt';
        $fileLogs = fopen($fileName, 'a');
        fwrite($fileLogs, implode("\t|\t", $this->logInfo) . PHP_EOL);
        fclose($fileLogs);
    }
}