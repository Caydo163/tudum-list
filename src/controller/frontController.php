<?php

require($rep."Connexion.php");


class FrontController {
    private $con;
    
    public function __construct() {
        global $dsn, $user, $pass, $rep, $vues, $erreur;
        // require("config/config.php");
        $this->con = new Connexion($dsn, $user, $pass);
        session_start();
        // $this->initialisation();

        try{
			$action=$_REQUEST['action'];

			switch($action) {
				case NULL:
					$this->initialisation();
					break;
                
                case "connexion":
                    require($rep.$vues['connexion']);
                    break;

				//mauvaise action
				default:
                    $TabErreur[] = $erreur['action'];
                    require($rep.$vues['erreur']);
				    break;
			}

		} catch (PDOException $e)
		{
			//si erreur BD, pas le cas ici
			$TabErreur[] = $erreur['pdo'];
			require ($rep.$vues['erreur']);

		}
		catch (Exception $e2)
			{
            $TabErreur[] = $erreur['autres'];
			require ($rep.$vues['erreur']);
			}


		//fin
		exit(0);
    }

    public function appelController() {
        // $_SESSION['role']
    }


    public function initialisation() {
        global $rep, $vues;
        require($rep."modeles/ListeGateway.php");
        require($rep."modeles/Liste.php");
        require($rep."modeles/Tache.php");
        require($rep."modeles/TacheGateway.php");
        $liste_gw = new ListeGateway($this->con);
        $tache_gw = new TacheGateway($this->con);
        
        foreach ($liste_gw->getAllListe() as $l) {
            if($l['owner'] == NULL){
                $owner = -1;
            } else{
                $owner = $l['owner'];
            } 
            $listes[] = new Liste($l['id'],utf8_encode($l['name']),$owner);

            $t = []; 
            foreach ($tache_gw->getTacheListe(end($listes)) as $value) {
                $t[] = new Tache($value['id'],$value['list'],utf8_encode($value['name']),$value['achieve']);
            }
            $taches[$l['id']] = $t;
        }
        require($rep.$vues['accueil']);
    }
}

?>