<html>
    <head>
        <title>TUDUM-LIST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="vues/style.css" rel="stylesheet">
    </head>
    <body>
      
      <?php require($rep.'vues/header.php');?>
        
        <main style="background-color: #3d3939">
        <div class="container py-3">
        <div class="row">

          
          <?php
          $cpt = 4;
          Foreach ($listes as $l) {
            if($cpt >= 4) {
              // echo '</div><div class="row">';
              $cpt = 0;
            }
            $cpt++;
            echo '
            <div class="col-auto">
            <div class="card rounded-4 mb-3" style="background-color: #656565;">
          <div class="card-body p-3">

          <h6>'.$l->getName().'</h6>
          <br>
          <ul class="list-group">';
          
            Foreach ($taches[$l->getId()] as $t) {
              echo '<li
              class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-3 mb-2">
              <div class="d-flex align-items-center">';
                  
              if($t->getRealise() == false){
                echo '<input class="form-check-input me-2" type="checkbox"><label>'.$t->getNom().'</label>';

              } else{
                echo '<input class="form-check-input me-2" type="checkbox" checked><label><strike>'.$t->getNom().'</strike></label>';
              }   

              
                echo '</div>
                <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                  <i class="fas fa-times text-primary"></i>
                </a>
              </li>';
              
            }

            
            echo '</ul>
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