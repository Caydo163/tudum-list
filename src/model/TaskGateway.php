<?php


class TaskGateway {

    private $con;  

    public function __construct() {
        global $con;
        $this->con = $con;
    }

    public function getTasksList($liste) {
        $query = "SELECT * FROM Task WHERE list = :list"; 
        $this->con->executeQuery($query, array(':list' => array($liste->getId(), PDO::PARAM_INT) ));
        $tasks = [];
        foreach ($this->con->getResults() as $task) {
            $tasks[] = new Task($task['list'],utf8_encode($task['name']),$task['achieve'],$task['id']);
        }
        return $tasks;
    }

    public function addTask($task) {
        $query = "INSERT INTO Task (name, list) VALUES (:name, :list);"; 
        $this->con->executeQuery($query, array(':name' => array(utf8_decode($task->getName()), PDO::PARAM_STR),':list' => array($task->getList(), PDO::PARAM_INT) ) );
    }

    public function removeTask($id) {
        $query = "DELETE FROM Task WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT) ) );
    }

    public function setAchieveTask($id, $bool) {
        $query = "UPDATE Task SET achieve = :bool WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':bool' => array($bool, PDO::PARAM_BOOL),':id' => array($id, PDO::PARAM_INT) ) );
    }

    public function getTaskById($id) {
        $query = "SELECT * FROM Task WHERE id = :id"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT)));
        if(empty($task = $this->con->getResults())) {
            return NULL;
        }
        $task = $task[0];
        return new Task(utf8_encode($task['list']),utf8_encode($task['name']),$task['achieve'],$task['id']);
    }

}


?>