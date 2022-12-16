<?php 

class AdminController {
    
    public function __construct($params) {
        global $dir, $views, $errors;
		
		$mdl_admin = new MdlAdmin();
		
		if(!$mdl_admin->isAdmin()) {
			require($dir.$views['account']);
			exit(0);
		}
		
        try{
			$action = (empty($params['action'])) ? null : $params['action'];
			switch(Validation::filterString($action)) {
                case NULL:
					$this->home();
                    break;
				
				case "removeUser":
					$this->removeUser($params['login']);
					break;

				case "listUser":
					$this->showUserList($params['login']);
					break;

				case "removeList":
					$this->removeList(intval($params['id']));
					break;

				case "removeTask":
					$this->removeTask(intval($params['id']));
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

    public function home($lists = [], $tasks = [], $user = '') {
        global $dir, $views;
        $user_gw = new UserGateway();
        $users = $user_gw->getAllUsers();
		$nomPage = 'a';
        require($dir.$views['admin']);
    }

	public function removeUser($login) {
		$user_gw = new UserGateway();
		$user = $user_gw->getUserByLogin($login);
		if($user->getAdmin()) {
			throw new Exception("Cet utilisateur ne peut pas être supprimé à cause de son rôle (admin)");
		}
		$user_gw->deleteUser($user);
		$this->home();
	}

	public function showUserList($login) {
		$list_gw = new ListGateway();
		$user_gw = new UserGateway();
		$task_gw = new TaskGateway();
		if(empty($login)) {
			$user = $user_gw->getUserByLogin($_SESSION['user_adminPage']);
		} else {
			$user = $user_gw->getUserByLogin($login);
			$_SESSION['user_adminPage'] = $user->getLogin();
		}
		$lists = $list_gw->getAllUserLists($user);
		$tasks = [];
		foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
		$this->home($lists, $tasks, $user->getLogin());
	}

	public function removeList($id) {
		$list_gw = new ListGateway();
		$av = new AccessVerify();
        if($av->listAccess($id)) {
			$list_gw->removeList($id);
			$this->showUserList($_SESSION['user_adminPage']);
        } else {
			throw new Exception("La liste demandé n'existe pas");
		}
	}

	public function removeTask($id) {
		$task_gw = new TaskGateway();
		$av = new AccessVerify();
		if($av->taskAccess($id)) {
			$task_gw->removeTask($id);
			$this->showUserList($_SESSION['user_adminPage']);
        } else {
			throw new Exception("La tâche demandé n'existe pas");
		}
    }
}

?>