<?php

class UserGateway {
    private $con;

    public function __construct() {
        global $con;
        $this->con = $con;
    }

    public function getUserByLogin($login) {
        $query = "SELECT * FROM User WHERE login = :login"; 
        $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR) ));
        $user = $this->con->getResults();
        if(count($user) == 0) {
            return NULL;
        }
        return new User(utf8_encode($user[0]['login']), $user[0]['password'], $user[0]['admin'], $user[0]['id']);
    }

    public function addUser($user) {
        $query = "INSERT INTO User (login, password) VALUES (:login, :password);"; 
        $this->con->executeQuery($query, array(':login' => array($user->getLogin(), PDO::PARAM_STR), ':password' => array($user->getPassword(), PDO::PARAM_STR)) );
    }

    public function deleteUser($user) {
        $query = "DELETE FROM User WHERE id = :id;"; 
        $this->con->executeQuery($query, array(':id' => array($user->getId(), PDO::PARAM_INT)) );
    }

    public function getAllUsers() {
        $query = "SELECT * FROM User"; 
        $this->con->executeQuery($query);
        foreach ($this->con->getResults() as $user) {
            $users[] = new User(utf8_encode($user['login']), $user['password'], $user['admin'], $user['id']);
        }
        return $users;
    }
}

?>