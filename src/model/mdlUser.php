<?php

class MdlUser {
    public function connexion($login, $mdp) {
        
    }

    public function deconnexion() {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function isUser() {
        // if (isset $_SESSION['login'] && isset $_SESSION['role']) {
        //     return null
        // }
        // return null;
    }
}

?>