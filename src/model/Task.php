<?php

class Task {
    private int $id;
    private int $list;
    private string $name;
    private bool $achieve;

    public function __construct($list, $name, $achieve = false, $id = -1) {
        $this->id = $id;
        $this->list = $list;
        $this->name = $name;
        $this->achieve = $achieve;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getList() : int {
        return $this->list;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getAchieve() : bool {
        return $this->achieve;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setList($list) {
        $this->list = $list;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAchieve($achieve) {
        $this->achieve = $achieve;
    }
}


?>