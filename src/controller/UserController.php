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
                case "u-list":
					$this->frontController->initialisation(false);
                    break;

				case "u-add_list":
					$this->addList();
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
        $this->frontController->initialisation(false);
    }



}

?>