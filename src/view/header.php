
<header class="p-3 bg-dark text-white">
    <div class="container-fluid mx-0 my-1">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="?action=" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <h1>TUDUM-LIST</h1>    
            </a>
            
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="?action=" class="nav-link px-2 text-<?= ($public) ? 'secondary' : 'white' ?>">Listes publiques</a></li>
                <li><a href="?action=u-private_list" class="nav-link px-2 text-<?= ($public) ? 'white' : 'secondary' ?>">Listes privées</a></li>
            </ul>
            
            <div class="text-end">
                <a href="?action=v-account">
                    <i class="bi bi-person-circle icon-white" style="font-size:2.5em;"></i></a>
                    <?= (isset($_SESSION['role']) && $_SESSION['role'] == 'user') ? '<p class="mb-0 text-center">'.$_SESSION['login'].'</p>' : null ?>
                
            </div>
        </div>
    </div>
</header>