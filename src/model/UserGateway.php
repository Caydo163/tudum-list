<?php

class UserGateway {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getUserByLogin($login) {
        $query = "SELECT * FROM User WHERE login = :login"; 
        $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR) ));
        $user = $this->con->getResults();
        if(count($user) == 0) {
            return NULL;
        }
        return new User(utf8_encode($user[0]['login']), $user[0]['password'],$user[0]['id']);
    }

    public function addUser($user) {
        $query = "INSERT INTO User (login, password) VALUES (:login, :password);"; 
        $this->con->executeQuery($query, array(':login' => array($user->getLogin(), PDO::PARAM_STR), ':password' => array($user->getPassword(), PDO::PARAM_STR)) );
    }
}

?>