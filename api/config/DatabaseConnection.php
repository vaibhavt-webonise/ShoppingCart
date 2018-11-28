<?php
    Class DatabaseConnection
    {
          public $host = "localhost";
          public $username = "root";
          public $password = "";
          public $dbName="ShoppingCart";
          public $conn;
          public function getConnection(){
            $this->conn = null;
            try{
              $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
              $this->conn->exec("set names utf8");
            }
            catch(PDOException $exception){
              echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
          }
    }
?>