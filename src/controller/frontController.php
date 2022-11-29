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
                    require($dir.$views['connexion']);
                    break;

                case "add_task":
                    $this->addTask();
                    break;

                case "add_list":
                    $this->addList();
                    break;
                
                case "remove_task":
                    $this->removeTask();
                    break;

                case "remove_list":
                    $this->removeList();
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
            echo $e2->getMessage();
            $detailErreur = $e2->getMessage();
			require ($dir.$views['erreur']);
			}


		//fin
		exit(0);
    }

    public function appelController() {
        // $_SESSION['role']
    }


    public function addTask() {
        global $dir, $views;
        $task_gw = new TaskGateway($this->con);
        $task = new Task(0, $_REQUEST['list'], $_REQUEST['task']);
        $task_gw->addTask($task);
        $this->initialisation();
    }

    public function addList() {
        global $dir, $views;
        $list_gw = new ListGateway($this->con);
        $list = new Liste(0, $_REQUEST['name']);
        $list_gw->addList($list);
        $this->initialisation();
    }

    public function removeTask() {
        $task_gw = new TaskGateway($this->con);
        $task_gw->removeTask($_REQUEST['id']);
        $this->initialisation();
    }

    public function removeList() {
        $list_gw = new ListGateway($this->con);
        $list_gw->removeList($_REQUEST['id']);
        $this->initialisation();
    }


    public function initialisation() {
        global $dir, $views;
        $list_gw = new ListGateway($this->con);
        $task_gw = new TaskGateway($this->con);
        
        foreach ($list_gw->getAllList() as $l) {
            if($l['owner'] == NULL){
                $owner = -1;
            } else{
                $owner = $l['owner'];
            } 
            $lists[] = new Liste($l['id'],utf8_encode($l['name']),$owner);

            $t = []; 
            foreach ($task_gw->getTasksList(end($lists)) as $value) {
                $t[] = new Task($value['id'],$value['list'],utf8_encode($value['name']),$value['achieve']);
            }
            $tasks[$l['id']] = $t;
        }
        require($dir.$views['accueil']);
    }
}

?>