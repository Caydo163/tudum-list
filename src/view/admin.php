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
            <div class="row p-4 w-100 h-75 justify-content-between" id="pageAdmin">

                <div class="col-4 card rounded-4 h-100">
                    <div class="card-body p-3">
                        <h3 class="text-white">Utilisateurs</h3>
                        <div class="rounded-3 overflow-auto h-75">
                            <ul class="list-group">
                                <?php
                            foreach($users as $u) {
                                $admin = ($u->getAdmin()) ? ' <span class="text-danger">(Admin)</span>' : '';
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-3 mb-2">
                                <p class="m-0">'.$u->getLogin().$admin.'</p>';
                                if(!$u->getAdmin()) {
                                    echo '
                                    <div>
                                    <a href="?action=a-list_user&login='.$u->getLogin().'" title="Afficher les listes de l\'utilisateur">
                                    <i class="bi bi-list"></i></a>
                                    <a href="?action=a-remove_user&delete_login='.$u->getLogin().'" title="Supprimer l\'utilisateur">
                                    <i class="bi bi-trash3 icon-red"></i>
                                    </a>
                                    </div>'
                                    ;
                                }
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-7">
                <?php
                    if($user == null) {
                        echo '<h3 class="text-white">Pas d\'utilisateur sélectionné</h3>';
                    } else {
                        echo '<h3 class="text-white">Utilisateur : '.$user.'</h3>';
                        if(empty($lists)) {
                            echo '<p class="text-white">L\'utilisateur n\'a pas de liste</p>';
                        }
                        echo '<div class="rounded-3 overflow-auto" style="height:90%">';
                        Foreach ($lists as $l) {    
                            echo '
                                <div class="col-auto">
                                <div class="card rounded-4 mb-3">
                                <div class="card-body p-3">
                                <div class="row justify-content-between">
                                <h6 class="col-auto">'.$l->getName().'</h6>';

                            echo '<a class="col-auto" href="?action=a-remove_list&id='.$l->getId().'" title="Supprimer la liste">';
                
                            echo '<i class="bi bi-trash3 icon-white"></i>
                                    </a>
                                    </div>
                                    <br>
                                    <ul class="list-group">';
                
                            Foreach ($tasks[$l->getId()] as $t) {
                            echo '<li
                            class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-3 mb-2">
                            <div class="d-flex align-items-center">';
                    
                    
                            if($t->getAchieve() == false){
                                echo '<input class="form-check-input my-0" type="checkbox" disabled="disabled"><label class="mx-2">'.$t->getName().'</label>';

                            } else{
                                echo '<input class="form-check-input my-0" type="checkbox" disabled="disabled" checked><label class="mx-2"><strike>'.$t->getName().'</strike></label>';
                            }   

                            
                            echo '</div>
                                <a href="?action=a-remove_task&id='.$t->getId().'" title="Supprimer la tâche">
                                    <i class="bi bi-trash3 icon-red"></i>
                                </a>
                                </li>';
                            }
                            echo '</ul></div></div></div>';
                        }
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        </main>
        <?php require('footer.php') ?>
    </body>
</html>