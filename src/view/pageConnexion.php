<?php $public = true ?>
<html>
    <head>
        <title>TUDUM-LIST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="view/style.css" rel="stylesheet">
    </head>
    <main>
        <?php require('header.php'); ?>
        
        <body>
            <?= (isset($errorMessage)) ? '<h3 style="color:white">'.$errorMessage.'</h3>' : null ?>
            <form method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="login" value="<?= (isset($login)) ? $login : null ?>">
                    <label for="floatingInput">Login</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="password">
                    <label for="floatingPassword">Mot de passe</label>
                </div>
                <input type="hidden" name="action" value="v-connexion">
                <button type="submit" class="btn btn-warning" style="background-color:#E50914;border:#E50914 1px solid;">Se connecter</button>
            </form>
        </body>

        <footer>
                
        </footer>
    </main>
</html>