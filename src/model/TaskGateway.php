<?php


class TaskGateway {

    private $con;  

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAllTask() {
        $query = "SELECT * FROM Task"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
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

    public function getTaskDone() {
        $query = "SELECT * FROM Task WHERE achieve = true"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function getTaskUnrealized() {
        $query = "SELECT * FROM Task WHERE achieve = false"; 
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function addTask($task) {
        $query = "INSERT INTO Task (name, list) VALUES (:name, :list);"; 
<<<<<<< HEAD
        $this->con->executeQuery($query, array(':name' => array($task->getName(), PDO::PARAM_STR),':list' => array($task->getList(), PDO::PARAM_INT) ) );
=======
        $this->con->executeQuery($query, array(':name' => array($tache->getName(), PDO::PARAM_STR),':list' => array($tache->getList(), PDO::PARAM_INT) ) );
>>>>>>> 8971c1c8bb5ae1beaf3c597bdec682d05da289d2
    }

    public function removeTask($id) {
        $query = "DELETE FROM Task WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($id, PDO::PARAM_INT) ) );
    }

}


?>