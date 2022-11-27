<?php


class TacheGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAllTache() {
        $query = "SELECT * FROM Task"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function getTacheListe($liste) {
        $query = "SELECT * FROM Task WHERE list = :list"; 
        $this->con->executeQuery($query, array(':list' => array($liste->getId(), PDO::PARAM_INT) ));
        return $this->con->getResults();
    }

    public function getTacheRealise() {
        $query = "SELECT * FROM Task WHERE achieve = true"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function getTacheNonRealise() {
        $query = "SELECT * FROM Task WHERE achieve = false"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function ajouterTache($tache) {
        $query = "INSERT INTO Task (name, list) VALUES (:name, :list);"; 
        $this->con->executeQuery($query, array(':name' => array($tache->getNom(), PDO::PARAM_STR),':list' => array($tache->getListe(), PDO::PARAM_INT) ) );
    }

    public function supprimerTache($id) {
        $query = "DELETE FROM Task WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT) ) );
    }

}


?>