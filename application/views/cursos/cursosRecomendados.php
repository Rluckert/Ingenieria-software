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
        <p><?=$curso->descripcion;?></p>
        <p>Horas: <?=$curso->horas;?></p>
       <center><a href="" class=""></a></center>
      </div>
    </div>
  </div>
<?php
}


?>

</div>