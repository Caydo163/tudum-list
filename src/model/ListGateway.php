<?php

// require('Connexion.php');

class ListGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAllList() {
        $query = "SELECT * FROM List"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function addList($liste) {
        if($liste->getOwner == -1) {
            $query = "INSERT INTO List (name, owner) VALUES (:name, -1);"; 
            $this->con->executeQuery($query, array(':name' => array($liste->getName(), PDO::PARAM_STR)) );
        }
        else {
            $query = "INSERT INTO List (name, owner) VALUES (:name, :owner);"; 
            $this->con->executeQuery($query, array(':name' => array($liste->getName(), PDO::PARAM_STR),':owner' => array($liste->getOwner(), PDO::PARAM_INT) ) );
        }
    }

    public function removeList($id) {
        $query = "DELETE FROM List WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT) ) );
    }

    public function getAllTask($liste) {
        $query = "SELECT * FROM Task WHERE list = :id"; 
        $this->con->executeQuery($query, array(':id' => array($liste->getId(), PDO::PARAM_INT) ));
        return $this->con->getResults();
    }

}


?>