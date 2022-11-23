<?php


class TacheGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAllTache() {
        $query = "SELECT * FROM Tache"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function getTacheListe($liste) {
        $query = "SELECT * FROM Tache WHERE liste = :liste"; 
        $this->con->executeQuery($query, array(':liste' => array($liste->getId(), PDO::PARAM_INT) ));
        return $this->con->getResults();
    }

    public function getTacheRealise() {
        $query = "SELECT * FROM Tache WHERE realise = true"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function getTacheNonRealise() {
        $query = "SELECT * FROM Tache WHERE realise = false"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function ajouterTache($tache) {
        $query = "INSERT INTO Tache (nom, liste) VALUES (:nom, :liste);"; 
        $this->con->executeQuery($query, array(':nom' => array($tache->getNom(), PDO::PARAM_STR),':liste' => array($tache->getListe(), PDO::PARAM_INT) ) );
    }

    public function supprimerTache($tache) {
        $query = "DELETE FROM Tache WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($tache->getId(), PDO::PARAM_INT) ) );
    }

}


?>