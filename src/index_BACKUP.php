<html>

<body>

<?php

// require_once("Connexion.php");
    
require('TacheGateway.php');
require('Tache.php');
//A CHANGER 
$user= 'jucarvalhe';
$pass='achanger';
$dsn='mysql:host=localhost;dbname=dbjucarvalhe';
try{
    $con=new Connexion($dsn,$user,$pass);

    
    $tacheGateway = new TacheGateway($con);

    // $tache = new Tache(1, "PHP");
    // $tacheGateway->ajouterTache($tache);
    
    $results = $tacheGateway->getAllTache();
    Foreach ($results as $row) {
        $nom = $row['nom'];
        if($row['realise'] == true) {
            echo "<p><strike>$nom</strike></p>";
        }
        else {
            echo "<p>$nom</p>";
        }
        // echo '<br>';
    }


    // $query = "SELECT * FROM Tache"; 
    // $con->executeQuery($query);

    // $results=$con->getResults();
    // Foreach ($results as $row) {
    //     echo $row['nom'];
    //     echo '<br>';
    // }
}
catch( PDOException $Exception ) {
echo 'erreur';
echo $Exception->getMessage();}



?>

</body>
</html>
