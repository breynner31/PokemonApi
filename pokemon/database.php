<?php

class Database{

    private $host = 'localhost';
    private $db_name ='pokemon';
    private $username = 'root';
    private $password = '';

    public $conn;

    public function connect(){
        $this->conn = null;
    
    try{
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    }
    return $this->conn;
    }

    public function disconnect(){
        $this->conn = null;
    }

    public function executeQuery($query) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
?>