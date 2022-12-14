<html>
    <head>
      <title>TUDUM-LIST - Admin</title>
      <meta charset="utf-8" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
      <link href="view/custom.css" rel="stylesheet">
      <script type="text/javascript" src="view/popupDeleteUser.js"></script>
    </head>
    <body>
      
      <?php require($dir.'view/header.php');?>
        
        <main>
            <div class="row p-4 w-100 h-75 justify-content-between" id="pageAdmin">

                <div class="col-4 card rounded-4 h-100">
                    <div class="card-body p-3">
                        <h3 class="text-white mb-4">Utilisateurs</h3>
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
                                    <a data-bs-toggle="modal" data-bs-target="#deleteUser_popup" data-bs-whatever="'.$u->getLogin().'">
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

            <div class="modal fade" id="deleteUser_popup" data-bs-backdrop="static" aria-labelledby="deleteUser_popupLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background-color:#656565">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Confirmation suppression</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color:white"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-white" id="popup_message">Message</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a id="removeURL" type="button" class="btn btn-primary" title="Supprimer l\'utilisateur">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="col-7">
                <?php
                    if($user == null) {
                        echo '<h3 class="text-white">Pas d\'utilisateur sélectionné</h3>';
                    } else {
                        echo '<h3 class="text-white mb-3">Utilisateur : '.$user.'</h3>';
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