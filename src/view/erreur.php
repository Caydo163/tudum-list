
<html>
    <head>
        <title>TUDUM-LIST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="view/styleErreur.css" rel="stylesheet">
    </head>
    <main>
        <header>
        </header>
        
        <body>
            
            <div class="text-bg-dark">
                <h1>TUDUM-LIST</h1>   
                <h4>Erreur</h4>
                <p>
                    Il semblerait que vous ayez rencontré un problème (plus de détails ci-dessous)
                </p>
                <?php
                    echo "$typeErreur / ";
                    echo "$detailErreur";

                ?>
                
                </div>
            </div>
        </body>
        <footer>
                
        </footer>
    </main>
</html>
