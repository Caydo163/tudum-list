<?php

class User {
    private $id;
    private $login;
    private $password;

    public function __construct($login, $password, $id = -1) {
        $this->login = $login;
        $this->password = $password;
        $this->id = $id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }
}

?>