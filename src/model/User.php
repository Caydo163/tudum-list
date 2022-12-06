<?php

class User {
    private $id;
    private $login;
    private $password;
    private $admin;

    public function __construct($login, $password, $admin = false, $id = -1) {
        $this->login = $login;
        $this->password = $password;
        $this->id = $id;
        $this->admin = $admin;
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

    public function getAdmin() {
        return $this->admin;
    }
}

?>