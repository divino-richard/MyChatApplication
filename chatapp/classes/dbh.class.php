<?php

class Dbh{
    private $host = "localhost";//For the host name
    private $user = "root";//For the user name
    private $pwd = "Rich10261999";//For the password
    private $dbName = "chatapp";//For the database name

    protected function connect(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd );
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}