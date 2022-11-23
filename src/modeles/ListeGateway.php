<?php

// require('Connexion.php');

class ListeGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
        // $this->con = new Connexion($dsn, $username, $password);
    }

    public function getAllListe() {
        $query = "SELECT * FROM Liste"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function ajouterListe($liste) {
        $query = "INSERT INTO Liste (nom) VALUES (:nom, :owner);"; 
        $this->con->executeQuery($query, array(':nom' => array($liste->getNom(), PDO::PARAM_STR),':owner' => array($liste->getOwner(), PDO::PARAM_INT) ) );
    }

    public function supprimerListe($liste) {
        $query = "DELETE FROM Liste WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($liste->getId(), PDO::PARAM_INT) ) );
    }

    public function getAllTaches($liste) {
        $query = "SELECT * FROM Tache WHERE liste = :id"; 
        $this->con->executeQuery($query, array(':id' => array($liste->getId(), PDO::PARAM_INT) ));
        return $this->con->getResults();
    }

}


?>