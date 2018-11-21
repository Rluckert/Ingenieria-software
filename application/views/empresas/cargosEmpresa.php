<?php foreach ($empresa->result() as $dato) {?>

<div class="jumbotron text-center">
  <img src="<?= base_url().$dato->urlImage?>">
  <h1 class="display-4">Cargos de <?= $dato->empresa?></h1>
 
</div>
<?php } ?>


<div class="accordion" id="accordionExample">

<?php 

foreach ($cargos->result() as $cargo) {?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $cargo->idCargo;?>" aria-expanded="true" aria-controls="collapseOne">
          <h5><?=$cargo->cargo;?></h5>
        </button>
      </h5>
    </div>

    <div id="collapse<?= $cargo->idCargo;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
        <div class="col-md-auto"> 
        <img src="<?= base_url().$cargo->url?>" class="img-thumbnail" >
        
        </div>
        <div class="col-md-auto text-center">
        <br><br>
        <p><h6><?=$cargo->descripcion;?></h6></p>
        <h6>Cursos con los cuales puedes aspirar a este cargo: </h6>
        <ul class="list-group">
          <?php foreach ($cursos->result() as $curso){
            if ($cargo->idCargo == $curso->idCargo) {
              echo '<li class="list-group-item">'.$curso->NombreCursoCorto.'</li>';
            }
            }
            
            ?>
        </ul>
        <br>
        <a href="<?= base_url('user/addCargo/').$cargo->idCargo?>" class="btn btn-primary">Agregar a mi lista de deseos</a>
          
        </div>
       
      
        </div>
      </div>
    </div>
  </div>
<?php
}

?>



</div>


