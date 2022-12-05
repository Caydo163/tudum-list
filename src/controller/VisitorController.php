<?php 

class VisitorController {
    private $con;
    private $frontController;
    
    public function __construct($fc) {
        global $dsn, $user, $pass, $dir, $views, $errors;
        $this->con = new Connexion($dsn, $user, $pass);
        $this->frontController = $fc;

        try{
			switch($_REQUEST['action']) {
                case "v-account":
                    require($dir.$views['account']);
                    break;

                case "v-add_task":
                    $this->addTask();
                    break;

                case "v-add_list":
                    $this->addList();
                    break;
                
                case "v-remove_task":
                    $this->removeTask();
                    break;

                case "v-remove_list":
                    $this->removeList();
                    break;
                
                case "v-connexion":
                    $this->connexion();
                    break;

                case "v-inscription":
                    $this->inscription();
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

    public function addTask() {
        $task_gw = new TaskGateway($this->con);
        $task = new Task($_REQUEST['list'], strip_tags($_REQUEST['task']));
        $task_gw->addTask($task);
        $this->frontController->initialisation();
    }

    public function addList() {
        $list_gw = new ListGateway($this->con);
        $list = new Liste(strip_tags($_REQUEST['name']));
        $list_gw->addList($list);
        $this->frontController->initialisation();
    }

    public function removeTask() {
        $task_gw = new TaskGateway($this->con);
        $task_gw->removeTask($_REQUEST['id']);
        $this->frontController->initialisation();
    }

    public function removeList() {
        $list_gw = new ListGateway($this->con);
        $list_gw->removeList($_REQUEST['id']);
        $this->frontController->initialisation();
    }

    public function connexion() {
        $mdl_user = new MdlUser();
        if($mdl_user->connexion($_REQUEST['login'],$_REQUEST['password'])) {
            $this->frontController->initialisation();
        }
	}

    public function inscription() {
        global $dir, $views;
        // require($dir."model/User.php");
        // require($dir."model/UserGateway.php");
        // require($dir."NonExistingAction.php");
        $user_gw = new UserGateway($this->con);

        $user = $user_gw->getUserByLogin($_REQUEST['login']);
        if($user == NULL) {
            $user = new User(strip_tags($_REQUEST['login']), password_hash(strip_tags($_REQUEST['password']), PASSWORD_DEFAULT));
            $user_gw->addUser($user);
            $_SESSION['role'] = 'user';
            $_SESSION['login'] = $user->getLogin();
            $this->frontController->initialisation();
        }
        else {
            $errorMessageInscription = 'Login déjà utilisé';
            require($dir.$views['account']);       
        }
    }
}

?>