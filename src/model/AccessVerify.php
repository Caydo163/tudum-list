<?php

class AccessVerify {
    public function listAccess($id) {
        $list_gw = new ListGateway();
        $list = $list_gw->getListById($id);
        if($list != NULL) {
            if($list->getOwner() != -1) {
                if(!empty($_SESSION['role']) && !empty($_SESSION['login'])) {
                    if($this->userList($list)) {
                        return true;
                    }
                    if($_SESSION['role'] == 'admin' && !$this->adminList($list)) {
                        return true;
                    }
                }
                return false;
            }
            return true;
        }
        return false;
    }

    public function taskAccess($id) {
        $task_gw = new TaskGateway();
        $task = $task_gw->getTaskById($id);
        if($task != NULL) {
            return $this->listAccess($task->getList());
        }
        return false;
    }

    public function adminList($list) {
        $user_gw = new UserGateway();
        $user = $user_gw->getUserById($list->getOwner());
        return $user->getAdmin();
    }

    public function userList($list) {
        $user_gw = new UserGateway();
        $user = $user_gw->getUserByLogin($_SESSION['login']);
        return $user->getId() == $list->getOwner();
    }
}

?>