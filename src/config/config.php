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
$views['erreur']='view/erreur.php';
$views['accueil']='view/accueil.php';
$views['account']='view/account.php';


//Erreur
$errors['action']="L'action demandé n'existe pas";
$errors['pdo']='Erreur avec la base de données';
$errors['autres']='Une erreur est survenu';


?>