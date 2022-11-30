<?php

class User {
    private $id;
    private $login;
    private $hashPassword;

    public function __construct($login, $password, $id = -1) {
        $this->login = $login;
        $this->hashPassword = $password;
        $this->id = $id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getHashPassword() {
        return $this->hashPassword;
    }
}

?>