
<html>
    <head>
        <title>TUDUM-LIST</title>
        <meta charset="UTF-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="view/styleErreur.css" rel="stylesheet">
    </head>
    <body style="background-color:#3d3939">
        <main>
            <div class="container d-flex h-100">

                <div class="align-self-center w-30 text-bg-dark p-5 rounded-4 mx-auto">
                    <h1 class="text-center">TUDUM-LIST</h1>   
                <!-- <h4>Erreur</h4>
                <p>
                    Il semblerait que vous ayez rencontré un problème (plus de détails ci-dessous)
                </p> -->
                <?php
                    if(!empty($typeErreur)) {
                        echo '<h4 class="font-weight-bold text-white text-center">'.$typeErreur.'</h4> <br>';
                    }
                    if(!empty($detailErreur)) {
                        echo '<p class="text-center">'.$detailErreur.'</p>';
                    }
                ?>
                <a href="?action=">Revenir sur le site</a>
                
            </div>
        </div>
    </div>
        </main>
    </body>
</html>
