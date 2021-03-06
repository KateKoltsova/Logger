<?php

namespace Logger;

/**
 * Class for connection to Database and creating table for writing logs.
 */
class DataBase
{
    /**
     * Consist Database connection.
     * @var \PDO
     */
    public $dbc;

    /**
     * Function for connecting to Database.
     */
    public function __construct()
    {
        $this->dbc = new \PDO('mysql:host=localhost', 'debian-sys-maint', 'eVm4rtYFay7HVoW7');
        $db = $this->dbc->prepare('CREATE DATABASE IF NOT EXISTS Test');
        $db->execute();
        $this->dbc = new \PDO('mysql:dbname=Test; host=localhost', 'debian-sys-maint', 'eVm4rtYFay7HVoW7');
    }

    /**
     * Function for creating table for writing logs.
     * @param string $name
     * @param string $sql
     * @return void
     */
    public function createTable(string $name, string $sql)
    {
        $consistTable = $this->dbc->prepare("SHOW TABLES FROM Test LIKE '$name';");
        $consistTable->execute();
        $data = $consistTable->fetchAll(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            $logTable = $this->dbc->prepare("CREATE TABLE Test.$name ($sql)");
            $logTable->execute();
        }
    }
}