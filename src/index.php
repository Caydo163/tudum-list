<?php
// require_once(__DIR__.'/config/config.php');
// require_once(__DIR__.'/config/Autoload.php');
// Autoload::charger();
// $fc = new FrontController();
?>

<?php
require_once(__DIR__.'/config/config.php');
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();
$router = new AltoRouter();
$router->setBasePath('/tudum-list/src');
// $router->map('GET', '/', 'AppController');
$router->map('GET|POST', '/', 'VisitorController');
$router->map('GET|POST', '/[*:action]', 'VisitorController');
$router->map('GET|POST', '/le', 'VisitorController');

$id =0;
$match = $router->match();
// echo var_dump($match);

$action = array();
$id=array();
if (!$match) {
    $typeErreur = $errors['autres'];
    $detailErreur = "Problème de chemin";
    require ($dir.$views['error']);
}
if ($match) {
//list($controller, $action) = explode('#', $match['target'] );
    $controller=$match['target'] ?? null;
    $action=$match['params']['action'] ?? null;
    $id=$match['params']['id'] ?? null;
    // echo $match['params'];

try {
    $controller = new FrontController($match['params']);
    // if (is_callable(array($controller, $action))) {
    //     call_user_func_array(array($controller, $action),
    //         array($match['params']));
    // }
}
catch (Error $error){print 'pas de controller';}
}
?>