<?php $public = true ?>
<html>
    <head>
        <title>TUDUM-LIST</title>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link href="view/style.css" rel="stylesheet">
    </head>
    <main>
        <?php require('header.php'); ?>
        
        <body>
            <div class="w-50 card rounded-4 mx-auto mt-5" style="background-color: #656565;">
                <div class="card-body p-3">            
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                        <h3 style="color:white">Connecté en tant que <?= $_SESSION['login'] ?></h3>
                        <a type="submit" class="btn btn-warning mt-3" style="background-color:#E50914;border:#E50914 1px solid;" href="?action=u-deconnexion">Se déconnecter</a>
                    <?php else: ?>
                        <form method="POST">
                            <h3 style="color:white">Connexion</h3>
                            <div class="form-floating mb-3 mt-2">
                                <input type="text" class="form-control" id="floatingInput" name="login" value="<?= (isset($login)) ? $login : null ?>" required>
                                <label for="floatingInput">Login</label>
                            </div>
                            <input type="hidden" name="action" value="v-connexion">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" required>
                                <label for="floatingPassword">Mot de passe</label>
                            </div>
                            <?= (isset($errorMessageConnexion)) ? '<p style="color:white">'.$errorMessageConnexion.'</p>' : null ?>
                            <button type="submit" class="btn btn-warning mt-2" style="background-color:#E50914;border:#E50914 1px solid;">Se connecter</button>
                        </form>
                        
                        <form class="mt-5" method="POST">
                            <h3 style="color:white">Inscription</h3>
                            <div class="form-floating mb-3 mt-2">
                                <input type="text" class="form-control" id="floatingInput" name="login" required>
                                <label for="floatingInput">Login</label>
                            </div>
                            <input type="hidden" name="action" value="v-inscription">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" required>
                                <label for="floatingPassword">Mot de passe</label>
                            </div>
                            <?= (isset($errorMessageInscription)) ? '<p style="color:white">'.$errorMessageInscription.'</p>' : null ?>
                            <button type="submit" class="btn btn-outline-light mt-2">S'inscrire</button>
                        </form>
                    
                    <?php endif ?>
                </div>
            </div>
        </body>

        <footer>     
        </footer>
    </main>
</html>