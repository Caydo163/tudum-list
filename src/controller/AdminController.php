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

				case "a-list_user":
					$this->showUserList();
					break;

				case "a-remove_list":
					$this->removeList();
					break;

				case "a-remove_task":
					$this->removeTask();
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

    public function home($lists = null, $tasks = null, $user = null) {
        global $dir, $views;
        $user_gw = new UserGateway();
        $users = $user_gw->getAllUsers();
		// if(!empty($_SESSION['user_adminPage'])) {
		// 	// $user = $user_gw->getUserByLogin($_SESSION['user_adminPage'])->getLogin();
		// 	// $this->showUserList($_SESSION['user_adminPage']);
		// }
        require($dir.$views['admin']);
    }

	public function removeUser() {
		$user_gw = new UserGateway();
		$user = $user_gw->getUserByLogin($_REQUEST['delete_login']);
		if($user->getAdmin()) {
			throw new Exception("Cet utilisateur ne peut pas être supprimé à cause de son rôle (admin)");
		}
		$user_gw->deleteUser($user);
		$this->home();
	}

	public function showUserList() {
		$list_gw = new ListGateway();
		$user_gw = new UserGateway();
		$task_gw = new TaskGateway();
		if(empty($_REQUEST['login'])) {
			$user = $user_gw->getUserByLogin($_SESSION['user_adminPage']);
		} else {
			$user = $user_gw->getUserByLogin($_REQUEST['login']);
			$_SESSION['user_adminPage'] = $user->getLogin();
		}
		$lists = $list_gw->getAllUserLists($user);
		$tasks = [];
		foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
		$this->home($lists, $tasks, $user->getLogin());
	}

	public function removeList() {
		$list_gw = new ListGateway();
		$av = new AccessVerify();
        if($av->listAccess($_REQUEST['id'])) {
			$list_gw->removeList($_REQUEST['id']);
			$this->showUserList();
        } else {
			throw new Exception("La liste demandé n'existe pas");
		}
	}

	public function removeTask() {
		$task_gw = new TaskGateway();
		$av = new AccessVerify();
		if($av->taskAccess($_REQUEST['id'])) {
			$task_gw->removeTask($_REQUEST['id']);
			$this->showUserList();
        } else {
			throw new Exception("La tâche demandé n'existe pas");
		}
    }

}

?>