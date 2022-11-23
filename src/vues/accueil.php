<html>
    <head>
        <title>TUDUM-LIST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
      
      <?php require('header.php');?>
        
        <main style="background-color: #3d3939">

        <?php
          Foreach ($listes as $l) {
            echo '
            <div class="card w-50" style="border-radius: 15px;background-color: #656565;">
          <div class="card-body p-5">

            <h6>'.$l->getName().'</h6>
            <br>
            <ul class="list-group mb-0">';

            Foreach ($taches[$l->getId()] as $t) {
              echo '<li
                class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-5 mb-2">
                <div class="d-flex align-items-center">';
                  
              if($t->getRealise() == false){
                echo '<input class="form-check-input me-2" type="checkbox"><p>'.$t->getNom().'</p>';

              } else{
                echo '<input class="form-check-input me-2" type="checkbox" checked><p><strike>'.$t->getNom().'</strike></p>';
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
';
        }
        ?>
        </main>
        <footer>
                
        </footer>
      </body>
</html>