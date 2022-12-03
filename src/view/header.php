
<header class="p-3 bg-dark text-white">
    <div class="container-fluid" style="margin:0 5px;">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="?action=" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <h1>TUDUM-LIST</h1>    
            </a>
            
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="?action=" class="nav-link px-2 text-<?= ($public) ? 'secondary' : 'white' ?>">Listes publiques</a></li>
                <li><a href="?action=u-private_list" class="nav-link px-2 text-<?= ($public) ? 'white' : 'secondary' ?>">Listes privées</a></li>
            </ul>
            
            <div class="text-end">
                <!-- <a type="button" class="btn btn-outline-light me-2" href="?action=<?= (isset($_SESSION['role']) && $_SESSION['role'] == 'user') ? 'u-deconnexion' : 'v-pageConnexion' ?>"><?= (isset($_SESSION['role']) && $_SESSION['role'] == 'user') ? 'Se déconnecter' : 'Se connecter' ?></a>
                <a type="button" class="btn btn-warning" style="background-color:#E50914;border:#E50914 1px solid;" href="?action=v-pageConnexion">S'inscrire</a> -->
                <a href="?action=v-account"><i class="bi bi-person-circle" style="color:white;font-size:2.5em;"></i></a>
            </div>
        </div>
    </div>
</header>