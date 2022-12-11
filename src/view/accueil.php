<html>
    <head>
      <title>TUDUM-LIST</title>
      <meta charset="utf-8" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <link href="view/custom.css" rel="stylesheet">
      <script type="text/javascript" src="view/checkbox.js"></script>    
    </head>
    <body>
      
      <?php require($dir.'view/header.php');?>
        
        <main>
        <div class="container py-3 justify-content-center">
        
        <div class="row justify-content-center m-0">
            <div class="card rounded-4 mb-5 w-75">
              <div class="card-body p-3">
              <form class="d-flex justify-content-flex-start align-items-center mb-0" method="POST">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Nouvelle liste ..." name="name" required>
                    <input type="hidden" name="action" value="<?= ($public) ? 'v-add_list' : 'u-add_list' ?>">
                  </div>
                  <div class="col-auto">
                    
                    <button type="submit" class="btn btn-outline-light mx-3">
                      Ajouter liste
                      <i class="bi bi-plus-square"></i>
                    </button>
                    </div>
              </form>
</div>
</div>
</div>
        <div class="row justify-content-center">

          
          <?php
          $role = ($public) ? '\'v\'' : '\'u\'';
          Foreach ($lists as $l) {
            echo '
            <div class="col-auto">
            <div class="card rounded-4 mb-3">
          <div class="card-body p-3">

          <div class="row justify-content-between">
          <h6 class="col-auto">'.$l->getName().'</h6>';

          if ($public) {
            echo '<a class="col-auto" href="?action=v-remove_list&id='.$l->getId().'" title="Remove list">';
          } else {
            echo '<a class="col-auto" href="?action=u-remove_list&id='.$l->getId().'" title="Remove list">';
          }
          
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
                echo '<input class="form-check-input my-0" type="checkbox" onclick="checkbox_js('.$t->getId().','.$role.')" id="'.$t->getId().'"><label class="mx-2">'.$t->getName().'</label>';

              } else{
                echo '<input class="form-check-input my-0" type="checkbox" onclick="checkbox_js('.$t->getId().','.$role.')" id="'.$t->getId().'" checked><label class="mx-2"><strike>'.$t->getName().'</strike></label>';
              }   

              
                echo '</div>';

                if ($public) {
                  echo '<a href="?action=v-remove_task&id='.$t->getId().'" title="Remove task">';
                } else {
                  echo '<a href="?action=u-remove_task&id='.$t->getId().'" title="Remove task">';
                }
                
                
                
                echo '<i class="bi bi-trash3 icon-red"></i>
                </a>
              </li>';
              
            }

            
            echo '</ul>
            <form class="d-flex justify-content-center align-items-center mt-4" method="POST">
                <input type="text" class="form-control" placeholder="Nouvelle tâche ..." name="task" required>';

                if ($public) {
                  echo '<input type="hidden" name="action" value="v-add_task">';
                } else {
                  echo '<input type="hidden" name="action" value="u-add_task">';
                }
                

                echo '<input type="hidden" name="list" value="'.$l->getId().'">
              <button type="submit" class="btn btn-primary ms-2">Ajouter</button>
            </form>
            </div>
            </div>
            </div>
            ';
          }
          ?>
      </div>

      <div class="row justify-content-between">
        <div>
          <a href="?action=<?= ($public) ? 'v' : 'u' ?>-change_page&page=<?= $page-1 ?>"><i class="bi bi-arrow-left-square-fill" style="color:#e50914;font-size:2em;"></i></a>
          <a href="?action=<?= ($public) ? 'v' : 'u' ?>-change_page&page=<?= $page+1 ?>"><i class="bi bi-arrow-right-square-fill" style="color:#e50914;font-size:2em;"></i></a>
        </div>
      </div>

      </div>
        </main>
          <?php require('footer.php') ?>
      </body>
</html>