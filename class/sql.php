<?php 

class Sql extends PDO {
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root","");
    }
    private function setParams($statment, $parameters = array()){

        foreach($parameters as $Key => $value){
            $this->setParams($Key, $value);
        }
    }

    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }

    public function query ($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();  
        return $stmt;  
    }

    public function select($rawQuery, $params = array())
    {
        $stmt = $this->query($rawQuery, $params);
        $stmt->fetchall(PDO::FETCH_ASSOC);

    }
}