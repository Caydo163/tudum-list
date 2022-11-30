<?php

class UserGateway {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getUser($login) {
        $query = "SELECT * FROM User WHERE login = :login"; 
        $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR) ));
        $user = $this->con->getResults();
        return new User(utf8_encode($user[0]['login']), $user[0]['password'],$user[0]['id']);
    }
}

?>