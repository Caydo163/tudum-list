<?php global $router ?>
<header class="p-3 bg-dark text-white">
    <div class="container-fluid mx-0 my-1">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="<?= $router->generate('visitor') ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <h1>TUDUM-LIST</h1>    
            </a>
            
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?= $router->generate('visitor') ?>" class="nav-link px-2 text-<?= ($nomPage == 'lpu') ? 'secondary' : 'white' ?>">Listes publiques</a></li>
                <li><a href="<?= $router->generate('user') ?>" class="nav-link px-2 text-<?= ($nomPage == 'lpr') ? 'secondary' : 'white' ?>">Listes privées</a></li>
                
                <?php if(isset($_SESSION['role']) && $_SESSION['role']== 'admin') {
                    $var = ($nomPage == 'a') ? 'secondary' : 'white';
                    echo '<li><a href="'.$router->generate('admin').'" class="nav-link px-2 text-'.$var.'">Page Admin</a></li>';
                }
                ?>
            </ul>
            
            <div class="text-center">
                <a href="<?= $router->generate('visitor', array('action' => 'account')) ?>">
                    <i class="bi bi-person-circle icon-white" style="font-size:2.5em;"></i></a>
                    <?= (isset($_SESSION['role']) && in_array($_SESSION['role'], array('user','admin'))) ? '<p class="mb-0">'.$_SESSION['login'].'</p>' : null ?>
            </div>
        </div>
    </div>
</header>