<?php

class MdlAdmin {
    public function signIn($user) {
        global $dir, $views;
        $_SESSION['role'] = 'admin';
        $_SESSION['login'] = $user->getLogin();
        require($dir.$views['error']);
    }

    public function isAdmin() {
        if(isset($_SESSION['role']) && isset($_SESSION['login']) && $_SESSION['role'] == 'admin') {
            return true;
        }
        return false;
    }
}

?>