<?php
include "dbConfig.php";

class Database
{
    //database connexion
    private $host;
    private $dbName;
    private $username;
    private $password;
    public $conn;

    // get the database connection
    public function __construct($dbConfig)
    {
        $this->host = $dbConfig['dbhost'];
        $this->dbName = $dbConfig['dbName'];
        $this->username = $dbConfig['dbUserName'];
        $this->password = $dbConfig['dbPasswd'];
    }

    public function getConnection()
    {
        $this->conn = null;

        try {
            $dns = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
            $this->conn = new PDO($dns, $this->username, $this->password);
            $this->conn->exec("SET CHARACTER SET utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}