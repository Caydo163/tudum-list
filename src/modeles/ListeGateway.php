<?php

// require('Connexion.php');

class ListeGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
        // $this->con = new Connexion($dsn, $username, $password);
    }

    public function getAllListe() {
        $query = "SELECT * FROM List"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function ajouterListe($liste) {
        $query = "INSERT INTO List (name, owner) VALUES (:name, :owner);"; 
        $this->con->executeQuery($query, array(':name' => array($liste->getName(), PDO::PARAM_STR),':owner' => array($liste->getOwner(), PDO::PARAM_INT) ) );
    }

    public function supprimerListe($id) {
        $query = "DELETE FROM List WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT) ) );
    }

    public function getAllTaches($liste) {
        $query = "SELECT * FROM Tache WHERE list = :id"; 
        $this->con->executeQuery($query, array(':id' => array($liste->getId(), PDO::PARAM_INT) ));
        return $this->con->getResults();
    }

}


?>