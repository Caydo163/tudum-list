<?php $public = true ?>
<html>
    <head>
        <title>TUDUM-LIST</title>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link href="view/style.css" rel="stylesheet">
    </head>
    <main>
        <?php require('header.php'); ?>
        
        <body>
            <div class="w-50 card rounded-4 mx-auto mt-5" style="background-color: #656565;">
                <div class="card-body p-3">

                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                        <h3 style="color:white">Connecté en tant que <?= $_SESSION['login'] ?></h3>
                        <a class="btn btn-warning mt-3" style="background-color:#E50914;border:#E50914 1px solid;" href="?action=u-deconnexion">Se déconnecter</a>
                        
                        <!-- <a type="submit" class="btn btn-outline-light mt-3" href="?action=u-delete_account">Supprimer compte</a> -->
                        <button type="button" class="btn btn-outline-light mt-3" data-bs-toggle="modal" data-bs-target="#delete_popup">Supprimer compte</button>

                        <div class="modal fade" id="delete_popup" aria-labelledby="delete_popupLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation suppression</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer votre compte ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <a type="button" class="btn btn-primary" href="?action=u-delete_account">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
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