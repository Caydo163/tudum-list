<?php

class MdlUser {
    public function signIn($login, $password) {
        global $dir, $views;
        $user_gw = new UserGateway();        
          
        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $user = $user_gw->getUserByLogin($login);
        if($user != null) {
            if(password_verify($password, $user->getPassword())) {
                if($user->getAdmin()) {
                    $mdl_admin = new MdlAdmin();
                    $mdl_admin->signIn($user);
                } else {
                    $_SESSION['role'] = 'user';
                    $_SESSION['login'] = $user->getLogin();
                }
                return true;
            } else {
                $errorMessageConnexion = 'Mot de passe incorrect';
                $loginAutocompletion = strip_tags($_REQUEST['login']);
                require($dir.$views['account']);
            }
        } 
        else {
            $errorMessageConnexion = 'Utilisateur inconnu';
            require($dir.$views['account']);        
        }     
    }
        
    public function deconnexion() {
        session_unset();
        session_destroy();
        $_SESSION = array();
    } 

    public function isUser() {
        if(isset($_SESSION['role']) && isset($_SESSION['login']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')) {
            return true;
        }
        return false;
    }

    public function deleteAccount() {
        // TODO : verifier sir utilisateur existe
        $user_gw = new UserGateway();
		$list_gw = new ListGateway();
		$user = $user_gw->getUserByLogin(filter_var($_SESSION['login'], FILTER_SANITIZE_STRING));
		foreach($list_gw->getAllUserLists($user) as $l) {
			$list_gw->removeList($l->getId());
		}
		$user_gw->deleteUser($user);
    }

    public function registration($login, $password) {
        global $dir, $views;
        $user_gw = new UserGateway();
        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        $user = $user_gw->getUserByLogin($login);
        if($user == NULL) {
            $user = new User($login, password_hash($password, PASSWORD_DEFAULT));
            $user_gw->addUser($user);
            $_SESSION['role'] = 'user';
            $_SESSION['login'] = $user->getLogin();
            return true;
        }
        else {
            $errorMessageInscription = 'Login déjà utilisé';
            require($dir.$views['account']);       
        }
    }
}

?>