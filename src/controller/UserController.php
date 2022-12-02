<?php 

require($dir."model/User.php");

class UserController {
    private $con;
    private $frontController;
    
    public function __construct($fc) {
        global $dsn, $user, $pass, $dir, $views, $errors;
        $this->con = new Connexion($dsn, $user, $pass);
        $this->frontController = $fc;

        if($_SESSION['role'] != 'user') {
			require($dir.$views['connexion']);
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

				case "u-deconnexion":
					$this->deconnexion();
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
		global $dir;
        require($dir."model/UserGateway.php");
        $user_gw = new UserGateway($this->con);
        return $user_gw->getUserByLogin($_SESSION['login']);
	}

	public function addList() {
        global $dir, $views;
        $list_gw = new ListGateway($this->con);
        $list = new Liste(strip_tags($_REQUEST['name']),$this->user()->getId());
        $list_gw->addList($list);
        $this->initialisation();
    }

	public function deconnexion() {
		session_unset();
		session_destroy();
		$_SESSION = array();
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



}

?>