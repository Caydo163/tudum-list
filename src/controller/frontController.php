<?php



class FrontController {

    public function __construct() {
        require("config/config.php");
        // $this->con = new Connexion($dsn, $username, $password);
        session_start();
        // $this->initialisation();
    }

    public function appelController() {
        // $_SESSION['role']
    }


    public function initialisation() {
        require("modeles/ListeGateway.php");
        ListeGateway liste_gw = new ListeGateway();
        // print(tache_gw.getAllTache());
        require("vues/accueil.php");
    }
}

?>