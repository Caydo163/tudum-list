<?php 

class UserController {
    private $con;
    private $frontController;
    
    public function __construct($fc) {
        global $dsn, $user, $pass, $dir, $views, $errors;
        $this->con = new Connexion($dsn, $user, $pass);
        $this->frontController = $fc;
		
		$mdl_user = new MdlUser();
		
		if(!$mdl_user->isUser()) {
			require($dir.$views['account']);
			exit(0);
		}
		

        try{
			$action=$_REQUEST['action'];

			switch($action) {
                case "u-private_list":
					$this->privateListPage();
                    break;

				case "u-add_list":
					$this->addList();
					break;

				case "u-remove_list":
					$this->removeList();
					break;
				
				case "u-add_task":
					$this->addTask();
					break;

				case "u-remove_task":
					$this->removeTask();
					break;

				case "u-deconnexion":
					$this->deconnexion();
					break;
				
				case "u-delete_account":
					$this->deleteAccount();
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

	public function user() {
        $user_gw = new UserGateway($this->con);
        return $user_gw->getUserByLogin($_SESSION['login']);
	}

	public function addList() {
        global $dir, $views;
        $list_gw = new ListGateway($this->con);
        $list = new Liste(strip_tags($_REQUEST['name']),$this->user()->getId());
        $list_gw->addList($list);
        $this->privateListPage();
    }
	
	public function removeList() {
		$list_gw = new ListGateway($this->con);
		$list_gw->removeList($_REQUEST['id']);
		$this->privateListPage();
	}

	public function removeTask() {
        $task_gw = new TaskGateway($this->con);
        $task_gw->removeTask($_REQUEST['id']);
		$this->privateListPage();
    }

	public function addTask() {
        $task_gw = new TaskGateway($this->con);
        $task = new Task($_REQUEST['list'], strip_tags($_REQUEST['task']));
        $task_gw->addTask($task);
		$this->privateListPage();
    }

	public function deconnexion() {
		$mdl_user = new MdlUser();
		$mdl_user->deconnexion();
		$this->frontController->initialisation();
	}

	public function privateListPage() {
        global $dir, $views;
        $list_gw = new ListGateway($this->con);
        $task_gw = new TaskGateway($this->con);
        
        $lists = $list_gw->getAllUserLists($this->user());
        foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
		$public = false;
        require($dir.$views['accueil']);
    }

	public function deleteAccount() {
		$mdl_user = new MdlUser();
		$mdl_user->deleteAccount();
		$mdl_user->deconnexion();
		$this->frontController->initialisation();

	}



}

?>