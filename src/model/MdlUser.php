<?php

class MdlUser {
    public function signIn($login, $password) {
        global $dir, $views;
        $user_gw = new UserGateway();
          
        $login = Validation::filterString($login);
        $password = Validation::filterString($password);
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
                $loginAutocompletion = Validation::filterString($_REQUEST['login']);
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
        $user_gw = new UserGateway();
		$list_gw = new ListGateway();
		$user = $user_gw->getUserByLogin(Validation::filterString($_SESSION['login']));
		foreach($list_gw->getAllUserLists($user) as $l) {
			$list_gw->removeList($l->getId());
		}
		$user_gw->deleteUser($user);
    }

    public function registration($login, $password) {
        global $dir, $views;
        $user_gw = new UserGateway();
        $login = Validation::filterString($login);
        $password = Validation::filterString($password);

        if(strlen($login) <= 20) {     
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
        else {
            $errorMessageInscription = 'Login trop long (limité à 20 caractères)';
            require($dir.$views['account']);
        }
    }
}

?>