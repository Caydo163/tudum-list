<?php

class Liste {
    private int $id;
    private string $nom;
    private $tabTaches = array();

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function getTabTaches() : array {
        return $this->tabTaches;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function ajouterTache($tache) {
        $tabTaches[] = $tabTaches;
    }

    public function supprimerTache($tache) {
        unset($tabTaches[array_search($tache, $tabTaches)]);
    }
}


?>