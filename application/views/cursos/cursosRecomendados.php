
<div class="accordion" id="accordionExample">
<?php 

foreach ($cursos->result() as $curso) {?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $curso->idCurso;?>" aria-expanded="true" aria-controls="collapseOne">
          <h5><?=$curso->nombreCurso;?></h5>
        </button>
      </h5>
    </div>

    <div id="collapse<?= $curso->idCurso;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <div class="row">
        <div class="col-md-auto"> 
        <img src="<?= base_url().$curso->url?>" class="img-thumbnail" >
        
        </div>
        <div class="col-md-auto text-center">
        <br><br>
        <p><h6><?=$curso->descripcion;?></h6></p>
        <p>Categoría: <?= $curso->categoria;?></p>
        <p>Horas: <?=$curso->horas;?></p>
        <a href="<?= base_url('user/addCursoRuta/').$curso->idCurso?>" class="btn btn-primary">Agregar a mi ruta de cursos</a>
          
        </div>
       
      
        </div>
      </div>
    </div>
  </div>
<?php
}


?>

</div>