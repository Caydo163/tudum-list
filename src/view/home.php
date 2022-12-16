<?php 
global $router;
$role = ($nomPage == 'lpu') ? 'visitor' : 'user';
?>
<html>
    <head>
      <title>TUDUM-LIST</title>
      <meta charset="utf-8" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <link href="view/custom.css" rel="stylesheet">
      <link href="../view/custom.css" rel="stylesheet">
      <link href="../../view/custom.css" rel="stylesheet">
      <script type="text/javascript" src="view/checkbox.js"></script>    
      <script type="text/javascript" src="../view/checkbox.js"></script>    
      <script type="text/javascript" src="../../view/checkbox.js"></script>    
    </head>
    <body>
      
      <?php require($dir.'view/header.php');?>
        
        <main>
        <div class="container py-3 justify-content-center">
        
        <div class="row justify-content-center m-0">
            <div class="card rounded-4 mb-5 w-75">
              <div class="card-body p-3">
              <form class="d-flex justify-content-flex-start align-items-center mb-0" method="POST" action="<?= $router->generate($role, array("action" => "addList")) ?>">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Nouvelle liste ..." name="name" required>
                  </div>
                  <div class="col-auto">
                    
                    <button type="submit" class="btn btn-outline-light mx-2">
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
          Foreach ($lists as $l) {
            echo '
            <div class="col-auto">
            <div class="card rounded-4 mb-3">
          <div class="card-body p-3">

          <div class="row justify-content-between">
          <h6 class="col-auto">'.$l->getName().'</h6>';

          echo '<a class="col-auto" href="'.$router->generate($role, array("action" => "removeList", "id" => $l->getId())).'" title="Supprimer la liste">';
          
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
                echo '<input class="form-check-input my-0" type="checkbox" onclick="checkbox_js('.$t->getId().',\''.$role.'\')" id="'.$t->getId().'"><label class="mx-2">'.$t->getName().'</label>';

              } else{
                echo '<input class="form-check-input my-0" type="checkbox" onclick="checkbox_js('.$t->getId().',\''.$role.'\')" id="'.$t->getId().'" checked><label class="mx-2"><strike>'.$t->getName().'</strike></label>';
              }   

              
                echo '</div>';

                echo '<a href="'.$router->generate($role, array("action" => "removeTask", "id" => $t->getId())).'" title="Supprimer tâche">';

                echo '<i class="bi bi-trash3 icon-red"></i>
                </a>
              </li>';
              
            }

            
            echo '</ul>
            <form class="d-flex justify-content-center align-items-center mt-4" method="POST" action="'.$router->generate($role, array("action" => "addTask")).'">
                <input type="text" class="form-control" placeholder="Nouvelle tâche ..." name="name" required>';

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

      <div class="row">
        <div class="col-6 text-start">
          <a href="<?= $router->generate($role, array("action" => "changePage", "id" => $page-1)) ?>"><i class="bi bi-arrow-left-square-fill" style="color:#e50914;font-size:2em;"></i></a>
        </div>
        <div class="col-6 text-end">
          <a href="<?= $router->generate($role, array("action" => "changePage", "id" => $page+1)) ?>"><i class="bi bi-arrow-right-square-fill" style="color:#e50914;font-size:2em;"></i></a>
        </div>
      </div>

      </div>
        </main>
          <?php require('footer.php') ?>
      </body>
</html>