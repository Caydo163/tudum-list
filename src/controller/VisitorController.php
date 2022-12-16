<?php 

class VisitorController {
    
    public function __construct($params) {
        global $dir, $views, $errors;
        try{
            $action = (empty($params['action'])) ? null : $params['action'];
			switch(Validation::filterString($action)) {
                case NULL:
                    $this->initialisation();
                    break;

                case "account":
                    require($dir.$views['account']);
                    break;

                case "addTask":
                    $this->addTask();
                    break;

                case "addList":
                    $this->addList();
                    break;
                
                case "removeTask":
                    $this->removeTask($params['id']);
                    break;

                case "removeList":
                    $this->removeList($params['id']);
                    break;
                
                case "checkTask":
                    $this->setAchieveTask(true, $params['id']);
                    break;

                case "uncheckTask":
                    $this->setAchieveTask(false, $params['id']);
                    break;
                
                case "signIn":
                    $this->signIn();
                    break;

                case "registration":
                    $this->registration();
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

		} catch (Exception $e2)
        {
            $typeErreur = $errors['autres'];
            $detailErreur = $e2->getMessage();
            require ($dir.$views['error']);
        }
		exit(0);
    }

    public function addTask() {
        $task_gw = new TaskGateway();
        $task = new Task($_REQUEST['list'], Validation::filterString($_REQUEST['name']));
        $task_gw->addTask($task);
        $this->initialisation();
    }

    public function addList() {
        $list_gw = new ListGateway();
        $list = new Liste(Validation::filterString($_REQUEST['name']));
        $list_gw->addList($list);
        $this->initialisation();
    }

    public function removeTask($id) {
        $task_gw = new TaskGateway();
        $av = new AccessVerify();
        if($av->taskAccess($id)) {
            $task_gw->removeTask($id);
            $this->initialisation();
        } else {
            throw new Exception("La tâche demandé n'existe pas");
        }
    }

    public function removeList($id) {
        $list_gw = new ListGateway();
        $av = new AccessVerify();
        if($av->listAccess($id)) {
            $list_gw->removeList($id);
            $this->initialisation();
        } else {
            throw new Exception("La liste demandé n'existe pas");
        }
    }

    public function setAchieveTask($bool, $id) {
        $task_gw = new TaskGateway();
        $av = new AccessVerify();
        $idTask = Validation::filterString($id);
        if($av->taskAccess($idTask)) {
            $task_gw->setAchieveTask($idTask, $bool);
            $this->initialisation();
        } else {
            throw new Exception("La tâche demandé n'existe pas");
        }
    }

    public function signIn() {
        $mdl_user = new MdlUser();
        if($mdl_user->signIn($_REQUEST['login'],$_REQUEST['password'])) {
            $this->initialisation();
        }
	}

    public function registration() {
        $mdl_user = new MdlUser();
        if($mdl_user->registration($_REQUEST['login'], $_REQUEST['password'])) {
            $this->initialisation();
        }
    }

    public function pagination($nb){
        $_SESSION['page'] = Validation::filterInt($nb);
        $list_gw = new ListGateway();
        $nbLists = $list_gw->getNbrPublicList();
        $nbPagesMax = ceil($nbLists/6);
        if($_SESSION['page'] <= 1){
            $_SESSION['page'] = 1;
        }
        if($_SESSION['page'] >= $nbPagesMax){
            $_SESSION['page'] = $nbPagesMax;
        }
        $this->initialisation();
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