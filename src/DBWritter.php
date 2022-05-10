<?php

namespace Logger;

class DBWritter implements WritterInterface
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
        echo 'Writing to DataBase success!'.PHP_EOL;
    }
}