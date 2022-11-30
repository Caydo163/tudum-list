<?php

require($dir."Connexion.php");
require($dir."model/ListGateway.php");
require($dir."model/Liste.php");
require($dir."model/Task.php");
require($dir."model/TaskGateway.php");


class FrontController {
    private $con;
    
    public function __construct() {
        global $dsn, $user, $pass, $dir, $views, $errors;
        $this->con = new Connexion($dsn, $user, $pass);
        session_start();

        try{
			switch(explode("-",$_REQUEST['action'])[0]) {
				case NULL:
					$this->initialisation();
					break;
                
                case "v":
                    require($dir.'controller/VisitorController.php');
                    $vc = new VisitorController($this);
                    break;

                case "u":
                    require($dir.'controller/UserController.php');
                    $uc = new UserController($this);
                    break;
                
				//mauvaise action
				default:
                //levé exception
                    require($dir."NonExistingAction.php");
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


    public function initialisation() {
        global $dir, $views;
        $list_gw = new ListGateway($this->con);
        $task_gw = new TaskGateway($this->con);
        
        $lists = $list_gw->getAllList();
        foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
        require($dir.$views['accueil']);
    }
}

?>