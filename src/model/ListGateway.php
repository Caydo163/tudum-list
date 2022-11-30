<?php

class ListGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAllList() {
        $query = "SELECT * FROM List"; 
        $this->con->executeQuery($query);
        foreach ($this->con->getResults() as $list) {
            if($list['owner'] == NULL){
                $owner = -1;
            } else{
                $owner = $list['owner'];
            } 
            $lists[] = new Liste($list['name'],$owner,$list['id'],);
        }
        return $lists;
    }

    public function addList($list) {
        if($list->getOwner() == -1) {
            $query = "INSERT INTO List (name) VALUES (:name);"; 
            $this->con->executeQuery($query, array(':name' => array($list->getName(), PDO::PARAM_STR)) );
        }
        else {
            $query = "INSERT INTO List (name, owner) VALUES (:name, :owner);"; 
            $this->con->executeQuery($query, array(':name' => array($list->getName(), PDO::PARAM_STR),':owner' => array($list->getOwner(), PDO::PARAM_INT) ) );
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