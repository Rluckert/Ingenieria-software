<div class="accordion" id="accordionExample">

<?php 

foreach ($cursos->result() as $curso) {?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $curso->IdCursoCortoSena;?>" aria-expanded="true" aria-controls="collapseOne">
          <h5><?=$curso->NombreCursoCorto;?></h5>
        </button>
      </h5>
    </div>

    <div id="collapse<?= $curso->IdCursoCortoSena;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <p><?=$curso->DescripcionCorta;?></p>
        <p>Horas: <?=$curso->NoHoras;?></p>
        <p><?php ?></p>
       <center><a href="<?= base_url('user/addCursoRuta/').$curso->IdCursoCortoSena?>" class="btn btn-primary">Agregar a mi ruta de cursos</a></center>
      </div>
    </div>
  </div>
<?php
}


?>



</div>