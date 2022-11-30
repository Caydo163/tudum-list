<html>
    <head>
        <title>TUDUM-LIST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link href="view/style.css" rel="stylesheet">
    </head>
    <body>
      
      <?php require($dir.'view/header.php');?>
        
        <main style="background-color: #3d3939">
        <div class="container py-3">
        
        <div class="col-auto">
            <div class="card rounded-4 mb-3" style="background-color: #656565;">
              <div class="card-body p-3">
              <form class="d-flex justify-content-flex-start align-items-center" method="POST">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Nouvelle liste ..." name="name" required>
                    <input type="hidden" name="action" value="add_list">
                  </div>
                  <div class="col">
                    
                    <button type="submit" class="btn btn-outline-light">
                      Ajouter liste
                      <i class="bi bi-plus-square"></i>
                    </div>
                  </button>
              </form>
</div>
</div>
</div>
        <div class="row">

          
          <?php
          $cpt = 4;
          Foreach ($lists as $l) {
            echo '
            <div class="col-auto">
            <div class="card rounded-4 mb-3" style="background-color: #656565;">
          <div class="card-body p-3">

          <div class="row justify-content-between">
          <h6 class="col-auto">'.$l->getName().'</h6>
          <a class="col-auto" href="?action=remove_list&id='.$l->getId().'" title="Remove list">
          <i class="bi bi-trash3" style="color:white"></i>
        </a>
        </div>
          <br>
          <ul class="list-group">';
          
            Foreach ($tasks[$l->getId()] as $t) {
              echo '<li
              class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-3 mb-2">
              <div class="d-flex align-items-center">';
                  
              if($t->getAchieve() == false){
                echo '<input class="form-check-input me-2" type="checkbox"><label>'.$t->getName().'</label>';

              } else{
                echo '<input class="form-check-input me-2" type="checkbox" checked><label><strike>'.$t->getName().'</strike></label>';
              }   

              
                echo '</div>
                <a href="?action=remove_task&id='.$t->getId().'" title="Remove task">
                  <i class="bi bi-trash3" style="color:#E50914"></i>
                </a>
              </li>';
              
            }

            
            echo '</ul>
            <form class="d-flex justify-content-center align-items-center mt-4" method="POST">
                <input type="text" class="form-control" placeholder="Nouvelle tâche ..." name="task" required>
                <input type="hidden" name="action" value="add_task">
                <input type="hidden" name="list" value="'.$l->getId().'">
              <button type="submit" class="btn btn-warning ms-2" style="background-color:#E50914;border:#E50914 1px solid;">Ajouter</button>
            </form>
            </div>
            </div>
            </div>
            ';
          }
          ?>
      </div>
      </div>
        </main>
        <footer>
          
        </footer>
      </body>
</html>