<?php

$dir=__DIR__.'/../';

//BD IUT 
$user= 'jucarvalhe';
$pass='achanger';
$dsn='mysql:host=localhost;dbname=dbjucarvalhe';
$con=null;

//BD PC
$user='root';
$pass='';
$dsn='mysql:host=localhost;dbname=tudum-list';


//Vues
$views['error']='view/error.php';
$views['home']='view/home.php';
$views['account']='view/account.php';
$views['admin']='view/admin.php';


//Erreur
$errors['action']="L'action demandé n'existe pas";
$errors['pdo']='Erreur avec la base de données';
$errors['router']='Erreur avec le routeur';
$errors['others']='Une erreur est survenu';

?>