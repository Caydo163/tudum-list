<?php

// require($dir."Connexion.php");
// require($dir."model/ListGateway.php");
// require($dir."model/Liste.php");
// require($dir."model/Task.php");
// require($dir."model/TaskGateway.php");


class FrontController {
    
    public function __construct() {
        global $dsn, $user, $pass, $dir, $views, $errors,$con;

        session_start();

        try{
            $con = new Connexion($dsn, $user, $pass);
			switch(explode("-",$_REQUEST['action'])[0]) {
				case NULL:
					$this->initialisation();
					break;
                
                case "v":
                    $vc = new VisitorController($this);
                    break;

                case "u":
                    $uc = new UserController($this);
                    break;
                
				//mauvaise action
				default:
                //levé exception
                    throw new NonExistingAction("L'action demande n'existe pas");
				    break;
			}

		} catch (PDOException $e)
		{
			//si erreur BD, pas le cas ici
			$typeErreur = $errors['pdo'];
			$detailErreur = $e->getMessage();
			require ($dir.$views['erreur']);

		}
		catch (Exception $e2)
			{
            $typeErreur = $errors['autres'];
            $detailErreur = $e2->getMessage();
			require ($dir.$views['erreur']);
			}
		//fin
		exit(0);
    }


    public function initialisation($public = true) {
        global $dir, $views, $con;
        $list_gw = new ListGateway($con);
        $task_gw = new TaskGateway($con);
        
        $lists = $list_gw->getAllPublicLists();
        foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
        require($dir.$views['accueil']);
    }
}

?>