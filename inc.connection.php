<?php
class Connection
{

    private $host = "mysql:host=localhost;dbname=ebook-list";
    private $struser = "root";
    private $strpassword = "";
    public $connection;

    function __construct()
    {
        $this->connect();
    }

    function connect()
    {
        try {
            $conn = new PDO($this->host, $this->struser, $this->strpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $conn;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
