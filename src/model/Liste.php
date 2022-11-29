<?php

class Liste {
    private int $id;
    private int $owner;
    private string $name;
    private $tasks = array();

    public function __construct($id, $name, $owner = -1) {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getOwner() : int {
        return $this->owner;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getTasks() : array {
        return $this->tasks;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function addTask($task) {
        $tasks[] = $tasks;
    }

    public function removeTask($task) {
        unset($tasks[array_search($task, $tasks)]);
    }
}


?>