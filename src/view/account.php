<?php $nomPage = null ; global $router ?>
<html>
    <head>
        <title>TUDUM-LIST</title>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link href="../view/custom.css" rel="stylesheet">
        <link href="../../view/custom.css" rel="stylesheet">
        <link href="view/custom.css" rel="stylesheet">
    </head>
    <main>
        <?php require('header.php'); ?>
        
        <body>
            <div class="w-50 card rounded-4 mx-auto my-5">
                <div class="card-body p-3">

                    <?php if(isset($_SESSION['role']) && in_array($_SESSION['role'], array('user','admin'))): ?>
                        <h3 class="text-white">Connecté en tant que <?= $_SESSION['login'] ?></h3>
                        <a class="btn btn-primary mt-3" href="<?= $router->generate('user', array("action" => "deconnexion")) ?>">Se déconnecter</a>
                        
                        <button type="button" class="btn btn-outline-light mt-3" data-bs-toggle="modal" data-bs-target="#delete_popup">Supprimer compte</button>

                        <div class="modal fade" id="delete_popup" data-bs-backdrop="static" aria-labelledby="delete_popupLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color:#656565">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Confirmation suppression</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:white"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-white">Voulez-vous vraiment supprimer votre compte ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <a type="button" class="btn btn-primary" href="<?= $router->generate('user', array("action" => "deleteAccount")) ?>">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <?php else: ?>
                        <form method="POST" action="<?= $router->generate('visitor', array("action" => "signIn")) ?>">
                            <h3 class="text-white">Connexion</h3>
                            <div class="form-floating mb-3 mt-2">
                                <input type="text" class="form-control" id="floatingInput" name="login" <?= (isset($loginAutocompletion)) ? 'value="'.$loginAutocompletion.'"' : '" autofocus' ?> required>
                                <label for="floatingInput">Login</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" required <?= (isset($loginAutocompletion)) ? 'autofocus' : null ?>>
                                <label for="floatingPassword">Mot de passe</label>
                            </div>
                            <?= (isset($errorMessageConnexion)) ? '<p class="text-white">'.$errorMessageConnexion.'</p>' : null ?>
                            <button type="submit" class="btn btn-primary mt-2">Se connecter</button>
                        </form>
                        
                        <form class="mt-5" method="POST" action="<?= $router->generate('visitor', array("action" => "registration")) ?>">
                            <h3 class="text-white">Inscription</h3>
                            <div class="form-floating mb-3 mt-2">
                                <input type="text" class="form-control" id="floatingInput" name="login" required>
                                <label for="floatingInput">Login</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" required>
                                <label for="floatingPassword">Mot de passe</label>
                            </div>
                            <?= (isset($errorMessageInscription)) ? '<p class="text-white">'.$errorMessageInscription.'</p>' : null ?>
                            <button type="submit" class="btn btn-outline-light mt-2">S'inscrire</button>
                        </form>
                    
                    <?php endif ?>
                </div>
            </div>
        </body>

        <?php require('footer.php') ?>
    </main>
</html>