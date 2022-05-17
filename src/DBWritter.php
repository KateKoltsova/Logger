<?php

namespace Logger;

/**
 * Class for writing logs to the Database, implements WritterInterface.
 */
class DBWritter implements WritterInterface
{
    /**
     * @var Formatter
     */
    public Formatter $formatter;

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
    public function __construct()
    {
        $this->formatter = new Formatter();
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