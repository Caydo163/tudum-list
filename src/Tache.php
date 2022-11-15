<?php

class Tache {
    private int $id;
    private string $nom;
    private bool $realise;

    public function __construct($id, $nom, $realise = false) {
        $this->id = $id;
        $this->nom = $nom;
        $this->realise = $realise;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function getRealise() : bool {
        return $this->realise;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setRealise($realise) {
        $this->id = $realise;
    }
}


?>