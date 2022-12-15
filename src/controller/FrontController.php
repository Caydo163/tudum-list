<?php

class FrontController {
    
    public function __construct() {
        global $dsn, $user, $pass, $dir, $views, $errors, $con;
        session_start();
        try{
            $con = new Connexion($dsn, $user, $pass);
            
			switch(Validation::actionRole($_REQUEST['action'])) {
				case NULL:
					$this->initialisation();
					break;
                
                case "v":
                    $vc = new VisitorController($this);
                    break;

                case "u":
                    $uc = new UserController($this);
                    break;
                
                case "a":
                    $ac = new AdminController($this);
                    break;

                default:
                    throw new Exception("L'action demandé n'existe pas");
				    break;
			}

		} catch (PDOException $e)
		{
			$typeErreur = $errors['pdo'];
			$detailErreur = $e->getMessage();
			require ($dir.$views['error']);

		}
		catch (Exception $e2)
			{
            $typeErreur = $errors['autres'];
            $detailErreur = $e2->getMessage();
			require ($dir.$views['error']);
			}
		exit(0);
    }


    public function initialisation() {
        global $dir, $views;
        $list_gw = new ListGateway();
        $task_gw = new TaskGateway();
        if(empty($_SESSION['page'])) {
            $_SESSION['page'] = 1;
        }
        $page = $_SESSION['page'];
        $lists = $list_gw->getAllPublicListsPage($page);
        foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
        $nomPage = 'lpu';
        require($dir.$views['home']);
    }
}

?>