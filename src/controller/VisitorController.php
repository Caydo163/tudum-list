<?php 

class VisitorController {
    private $frontController;
    
    public function __construct($fc) {
        global $dir, $views, $errors;
        $this->frontController = $fc;

        try{
			switch(filter_var($_REQUEST['action'], FILTER_SANITIZE_STRING)) {
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
                
                case "v-check_task":
                    $this->setAchieveTask(true);
                    break;

                case "v-uncheck_task":
                    $this->setAchieveTask(false);
                    break;
                
                case "v-sign_in":
                    $this->signIn();
                    break;

                case "v-registration":
                    $this->registration();
                    break;

                case "v-change_page":
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
        $task = new Task($_REQUEST['list'], filter_var($_REQUEST['task'], FILTER_SANITIZE_STRING));
        $task_gw->addTask($task);
        $this->frontController->initialisation();
    }
    // TODO faire classe filtre
    // BUG delete user admin

    public function addList() {
        $list_gw = new ListGateway();
        $list = new Liste(filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING));
        $list_gw->addList($list);
        $this->frontController->initialisation();
    }

    public function removeTask() {
        $task_gw = new TaskGateway();
        $av = new AccessVerify();
        if($av->taskAccess($_REQUEST['id'])) {
            $task_gw->removeTask($_REQUEST['id']);
            $this->frontController->initialisation();
        } else {
            throw new Exception("La tâche demandé n'existe pas");
        }
    }

    public function removeList() {
        $list_gw = new ListGateway();
        $av = new AccessVerify();
        if($av->listAccess($_REQUEST['id'])) {
            $list_gw->removeList($_REQUEST['id']);
            $this->frontController->initialisation();
        } else {
            throw new Exception("La liste demandé n'existe pas");
        }
    }

    public function setAchieveTask($bool) {
        $task_gw = new TaskGateway();
        $av = new AccessVerify();
        if($av->taskAccess($_REQUEST['task'])) {
            $idTask = filter_var($_REQUEST['task'], FILTER_SANITIZE_STRING);
            $task_gw->setAchieveTask($idTask, $bool);
            $this->frontController->initialisation();
        } else {
            throw new Exception("La tâche demandé n'existe pas");
        }
    }

    public function signIn() {
        $mdl_user = new MdlUser();
        if($mdl_user->signIn($_REQUEST['login'],$_REQUEST['password'])) {
            $this->frontController->initialisation();
        }
	}

    public function registration() {
        $mdl_user = new MdlUser();
        if($mdl_user->registration($_REQUEST['login'], $_REQUEST['password'])) {
            $this->frontController->initialisation();
        }
    }

    public function pagination(){
        $_SESSION['page'] = filter_var($_REQUEST['page'],FILTER_SANITIZE_NUMBER_INT );
        $list_gw = new ListGateway();
        $nbLists = $list_gw->getNbrPublicList();
        $nbPagesMax = ceil($nbLists/6);
        if($_SESSION['page'] <= 1){
            $_SESSION['page'] = 1;
        }
        if($_SESSION['page'] >= $nbPagesMax){
            $_SESSION['page'] = $nbPagesMax;
        }
        $this->frontController->initialisation();
    }
}

?>