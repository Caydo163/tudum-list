<?php 

class AdminController {
    private $frontController;
    
    public function __construct($fc) {
        global $dir, $views, $errors;
        $this->frontController = $fc;
		
		$mdl_admin = new MdlAdmin();
		
		if(!$mdl_admin->isAdmin()) {
			require($dir.$views['account']);
			exit(0);
		}
		
        try{
			$action=$_REQUEST['action'];

			switch($action) {
                case "a-home":
					$this->home();
                    break;
				
				case "a-remove_user":
					$this->removeUser();
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

	public function user() {
        $user_gw = new UserGateway();
        return $user_gw->getUserByLogin($_SESSION['login']);
	}

    public function home() {
        global $dir, $views;
        $user_gw = new UserGateway();
        $users = $user_gw->getAllUsers();
        require($dir.$views['admin']);
    }

	public function removeUser() {
		$user_gw = new UserGateway();
		$user = $user_gw->getUserByLogin($_REQUEST['login']);
		if($user->getAdmin()) {
			throw new Exception("Cet utilisateur ne peut pas être supprimé à cause de son rôle (admin)");
		}
		$user_gw->deleteUser();
		$this->home();
	}

}

?>