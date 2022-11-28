<?php

$rep=__DIR__.'/../';

//BD IUT
$user= 'jucarvalhe';
$pass='achanger';
$dsn='mysql:host=localhost;dbname=dbjucarvalhe';

//BD PC
// $user='root';
// $pass='';
// $dsn='mysql:host=localhost;dbname=tudum-list';


//Vues
$vues['erreur']='vues/erreur.php';
$vues['accueil']='vues/accueil.php';
$vues['connexion']='vues/pageConnexion.php';


//Erreur
$erreur['action']="L'action demandé n'existe pas";
$erreur['pdo']='Erreur avec la base de données';
$erreur['autres']='Une erreur est survenu';


?>