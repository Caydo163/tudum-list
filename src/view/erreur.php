
<html>
    <head>
        <title>TUDUM-LIST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="view/styleErreur.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <div class="text-bg-dark p-5">
                <h1>TUDUM-LIST</h1>   
                <h4>Erreur</h4>
                <p>
                    Il semblerait que vous ayez rencontré un problème (plus de détails ci-dessous)
                </p>
                <?php
                    if(isset($typeErreur) && !empty($typeErreur)) {
                        echo "<h3>$typeErreur</h3> <br>";
                    }
                    if(isset($detailErreur) && !empty($detailErreur)) {
                        echo "<p>$detailErreur</p>";
                    }
                ?>
                <a href="?action=">Revenir sur le site</a>
                
                </div>
            </div>
        </main>
    </body>
</html>
