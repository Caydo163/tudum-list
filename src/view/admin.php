<?php $public = true ?>
<html>
    <head>
      <title>TUDUM-LIST - Admin</title>
      <meta charset="UTF-8" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <link href="view/custom.css" rel="stylesheet">
    </head>
    <body>
      
      <?php require($dir.'view/header.php');?>
        
        <main>
            <div class="w-50 card rounded-4 mx-auto my-5">
                <div class="card-body p-3">
                    <h3 class="text-white">Utilisateurs</h3>
                    <div class="overflow-auto">
                        <ul class="list-group">
                            <?php
                            foreach($users as $u) {
                                $admin = ($u->getAdmin()) ? ' <span class="text-danger">(Admin)</span>' : '';
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-3 mb-2">
                                <p class="m-0">'.$u->getLogin().$admin.'</p>';
                                if(!$u->getAdmin()) {
                                    echo '<a href="?action=a-remove_user&login='.$u->getLogin().'" title="Remove user">
                                    <i class="bi bi-trash3 icon-red"></i>
                                    </a>';
                                }
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
          <?php require('footer.php') ?>
      </body>
</html>