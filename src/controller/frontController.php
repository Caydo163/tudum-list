<?php



class FrontController {
    private $con;

    public function __construct() {
        require("config/config.php");
        $this->con = new Connexion($dsn, $user, $pass);
        session_start();
        $this->initialisation();
    }

    public function appelController() {
        // $_SESSION['role']
    }


    public function initialisation() {
        require("modeles/ListeGateway.php");
        require("modeles/Liste.php");
        require("modeles/Tache.php");
        require("modeles/TacheGateway.php");
        $liste_gw = new ListeGateway($this->con);
        $tache_gw = new TacheGateway($this->con);
        
        foreach ($liste_gw->getAllListe() as $l) {
            if($l['owner'] == NULL){
                $owner = -1;
            } else{
                $owner = $l['owner'];
            } 
            $listes[] = new Liste($l['id'],$l['nom'],$owner);

            $t = []; 
            foreach ($tache_gw->getTacheListe(end($listes)) as $value) {
                $t[] = new Tache($value['id'],$value['liste'],$value['nom'],$value['realise']);
            }
            $taches[$l['id']] = $t;
        }
        



        require("vues/accueil.php");
    }
}

?>