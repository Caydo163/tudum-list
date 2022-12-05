<?php

class MdlUser {


    public function connexion($login, $password) {
        global $dir, $views, $con;
        // require($dir."model/User.php");
        // require($dir."model/UserGateway.php");
        // require($dir."NonExistingAction.php");
        $user_gw = new UserGateway($con);        
          
        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $user = $user_gw->getUserByLogin($login);
        if($user != null) {
            if(password_verify($password, $user->getPassword())) {
                $_SESSION['role'] = 'user';
                $_SESSION['login'] = $user->getLogin();
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
        if(isset($_SESSION['role']) && isset($_SESSION['login']) && $_SESSION['role'] == 'user') {
            return true;
        }
        return false;
    }

    public function deleteAccount() {
        global $con;
        $user_gw = new UserGateway($con);
		$list_gw = new ListGateway($con);
		$user = $user_gw->getUserByLogin(filter_var($_SESSION['login'], FILTER_SANITIZE_STRING));
		foreach($list_gw->getAllUserLists($user) as $l) {
			$list_gw->removeList($l->getId());
		}
		$user_gw->deleteUser($user);
    } 
}

?>