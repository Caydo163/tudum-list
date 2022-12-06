<?php

class ListGateway {

    private $con;  

    public function __construct() {
        global $con;
        $this->con = $con;
    }

    public function getAllPublicLists() {
        $query = "SELECT * FROM List WHERE owner IS NULL"; 
        $this->con->executeQuery($query);
        foreach ($this->con->getResults() as $list) {
            $lists[] = new Liste(utf8_encode($list['name']),-1,$list['id']);
        }
        return $lists;
    }

    public function getAllUserLists($user) {
        $query = "SELECT * FROM List WHERE owner = :owner"; 
        $this->con->executeQuery($query, array(':owner' => array($user->getId(), PDO::PARAM_STR)));
        $lists = [];
        foreach ($this->con->getResults() as $list) {
            $lists[] = new Liste(utf8_encode($list['name']),$list['owner'],$list['id']);
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

    // public function getAllTask($liste) {
    //     $query = "SELECT * FROM Task WHERE list = :id"; 
    //     $this->con->executeQuery($query, array(':id' => array($liste->getId(), PDO::PARAM_INT) ));
    //     return $this->con->getResults();
    // }

    public function getListById($id) {
        $query = "SELECT * FROM List WHERE id = :id"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
        if(empty($list = $this->con->getResults())) {
            return NULL;
        }
        $list = $list[0];
        $owner = ($list['owner'] == NULL) ? -1 : $list['owner'];
        return new Liste(utf8_encode($list['name']),$owner,$list['id']);
    }

}


?>