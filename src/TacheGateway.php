<?php

require('Connexion.php');
// require('Tache.php');

class TacheGateway {

    private $con;  

    public function __construct($con) {
        // $user= 'jucarvalhe';
        // $pass='achanger';
        // $dsn='mysql:host=localhost;dbname=dbjucarvalhe';
        // $con = new Connexion($dsn,$user,$pass);
        $this->con = $con;
    }

    public function getAllTache() {
        $query = "SELECT * FROM Tache"; 
        $this->con->executeQuery($query);
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
        $query = "INSERT INTO Tache (nom) VALUES (:nom);"; 
        $this->con->executeQuery($query, array(':nom' => array($tache->getNom(), PDO::PARAM_STR) ) );
    }

}


?>