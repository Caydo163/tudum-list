<?php 

class UserController {
    
    public function __construct($params) {
        global $dir, $views, $errors;
		
		$mdl_user = new MdlUser();
		
		if(!$mdl_user->isUser()) {
			require($dir.$views['account']);
			exit;
		}
		
        try{
			$action = (empty($params['action'])) ? null : $params['action'];
			switch(Validation::filterString($action)) {
                case NULL:
					$this->privateListPage();
                    break;

				case "addList":
					$this->addList();
					break;

				case "removeList":
					$this->removeList($params['id']);
					break;
				
				case "addTask":
					$this->addTask();
					break;

				case "removeTask":
					$this->removeTask($params['id']);
					break;

				case "checkTask":
					$this->setAchieveTask(true, $params['id']);
					break;

				case "uncheckTask":
					$this->setAchieveTask(false, $params['id']);
					break;

				case "deconnexion":
					$this->deconnexion();
					break;
				
				case "deleteAccount":
					$this->deleteAccount();
					break;

				case "changePage":
					$this->pagination($params['id']);
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

	private function user() {
        $user_gw = new UserGateway();
		$user = $user_gw->getUserByLogin($_SESSION['login']);
		if($user == null) {
			$mdl_user = new MdlUser();
			$mdl_user->deconnexion();
			throw new Exception("L'utilisateur n'existe plus");
		}
        return $user;
	}

	public function addList() {
        global $dir, $views;
        $list_gw = new ListGateway();
        $list = new Liste(strip_tags($_REQUEST['name']),$this->user()->getId());
        $list_gw->addList($list);
        $this->privateListPage();
    }
	
	public function removeList($id) {
		$list_gw = new ListGateway();
		$av = new AccessVerify();
        if($av->listAccess($id)) {
			$list_gw->removeList($id);
			$this->privateListPage();
        } else {
			throw new Exception("La liste demandé n'existe pas");
		}
	}

	public function removeTask($id) {
		$task_gw = new TaskGateway();
		$av = new AccessVerify();
		if($av->taskAccess($id)) {
			$task_gw->removeTask($id);
			$this->privateListPage();
        } else {
			throw new Exception("La tâche demandé n'existe pas");
		}
    }

	public function addTask() {
        $task_gw = new TaskGateway();
        $task = new Task($_REQUEST['list'], strip_tags($_REQUEST['name']));
        $task_gw->addTask($task);
		$this->privateListPage();
    }

	public function setAchieveTask($bool, $id) {
        $task_gw = new TaskGateway();
		$av = new AccessVerify();
		$idTask = Validation::filterString($id);
		if($av->taskAccess($idTask)) {
			$task_gw->setAchieveTask($idTask, $bool);
			$this->privateListPage();
        } else {
			throw new Exception("La tâche demandé n'existe pas");
		}
    }

	public function deconnexion() {
		global $dir, $views;
		$mdl_user = new MdlUser();
		$mdl_user->deconnexion();
		require($dir.$views['account']);
	}

	public function privateListPage() {
        global $dir, $views;
        $list_gw = new ListGateway();
        $task_gw = new TaskGateway();
		if(empty($_SESSION['page_user'])){
            $_SESSION['page_user'] = 1;
        }
		$page = $_SESSION['page_user'];
        $lists = $list_gw->getAllUserListsPage($this->user(), $page);
        foreach ($lists as $l) {
            $tasks[$l->getId()] = $task_gw->getTasksList($l);
        }
		$nomPage = 'lpr';
        require($dir.$views['home']);
    }

	public function deleteAccount() {
		global $dir, $views;
		$mdl_user = new MdlUser();
		$mdl_user->deleteAccount();
		$mdl_user->deconnexion();
		require($dir.$views['account']);

	}

	public function pagination($nb){
        $_SESSION['page_user'] = Validation::filterInt($nb);
        $list_gw = new ListGateway();
        $nbLists = $list_gw->getNbrPrivateList($this->user());
        $nbPagesMax = ceil($nbLists/6);
        if($_SESSION['page_user'] <= 1){
            $_SESSION['page_user'] = 1;
        }
        if($_SESSION['page_user'] >= $nbPagesMax){
            $_SESSION['page_user'] = $nbPagesMax;
        }
        $this->privateListPage();
    }
}

?>