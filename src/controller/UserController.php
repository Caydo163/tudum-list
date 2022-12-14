<?php 

class UserController {
    private $frontController;
    
    public function __construct($fc) {
        global $dir, $views, $errors;
        $this->frontController = $fc;
		
		$mdl_user = new MdlUser();
		
		if(!$mdl_user->isUser()) {
			require($dir.$views['account']);
			exit;
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

				case "u-check_task":
					$this->setAchieveTask(true);
					break;

				case "u-uncheck_task":
					$this->setAchieveTask(false);
					break;

				case "u-deconnexion":
					$this->deconnexion();
					break;
				
				case "u-delete_account":
					$this->deleteAccount();
					break;

				case "u-change_page":
					$this->pagination();
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
	
	public function removeList() {
		$list_gw = new ListGateway();
		$av = new AccessVerify();
        if($av->listAccess($_REQUEST['id'])) {
			$list_gw->removeList($_REQUEST['id']);
			$this->privateListPage();
        } else {
			throw new Exception("La liste demandé n'existe pas");
		}
	}

	public function removeTask() {
		$task_gw = new TaskGateway();
		$av = new AccessVerify();
		if($av->taskAccess($_REQUEST['id'])) {
			$task_gw->removeTask($_REQUEST['id']);
			$this->privateListPage();
        } else {
			throw new Exception("La tâche demandé n'existe pas");
		}
    }

	public function addTask() {
        $task_gw = new TaskGateway();
        $task = new Task($_REQUEST['list'], strip_tags($_REQUEST['task']));
        $task_gw->addTask($task);
		$this->privateListPage();
    }

	public function setAchieveTask($bool) {
        $task_gw = new TaskGateway();
		$av = new AccessVerify();
		if($av->taskAccess($_REQUEST['task'])) {
			$task = filter_var($_REQUEST['task'], FILTER_SANITIZE_STRING);
			$task_gw->setAchieveTask($task, $bool);
			$this->privateListPage();
        } else {
			throw new Exception("La tâche demandé n'existe pas");
		}
    }

	public function deconnexion() {
		$mdl_user = new MdlUser();
		$mdl_user->deconnexion();
		$this->frontController->initialisation();
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
		$public = false;
        require($dir.$views['accueil']);
    }

	public function deleteAccount() {
		$mdl_user = new MdlUser();
		$mdl_user->deleteAccount();
		$mdl_user->deconnexion();
		$this->frontController->initialisation();

	}

	public function pagination(){
        $_SESSION['page_user'] = filter_var($_REQUEST['page'],FILTER_SANITIZE_NUMBER_INT);
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