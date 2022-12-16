<?php
    require_once(__DIR__.'/config/config.php');
    require_once(__DIR__.'/config/Autoload.php');
    Autoload::charger();

    global $router;
    $router = new AltoRouter();
    $router->setBasePath('/tudum-list/src');

    $router->map('GET|POST', '/', 'VisitorController');
    $router->map('GET|POST', '/admin/[a:action]/[i:id]?', 'AdminController', 'adminId');
    $router->map('GET|POST', '/admin/[a:action]?/[a:login]?', 'AdminController', 'admin');
    $router->map('GET|POST', '/user/[a:action]?/[i:id]?', 'UserController', 'user');
    $router->map('GET|POST', '/[a:action]/[i:id]?', 'VisitorController', 'visitor');

    $match = $router->match();
    if (!$match) {
        $typeErreur = $errors['router'];
        $detailErreur = "Le chemin n'existe pas";
        require ($dir.$views['error']);
    }
    else {
        try {
            session_start();
            $con = new Connexion($dsn, $user, $pass);

            switch($match['target']) {
                case 'VisitorController':
                    $c = new VisitorController($match['params']);
                    break;
                case 'UserController':
                    $c = new UserController($match['params']);
                    break;
                case 'AdminController':
                    $c = new AdminController($match['params']);
                    break;
            }
        }
        catch (Error $error) {
            $typeErreur = $errors['others'];
            $detailErreur = "Erreur";
            require ($dir.$views['error']);
        }
    }
?>