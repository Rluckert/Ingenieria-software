


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
        <p>Categoria: <?=$curso->categoria;?></p>
        <p>Horas: <?=$curso->horas;?></p>
        <p><?php 
        if ($curso->finalizado == 1) {
          echo "Estado: Finalizado";
        }else{
          echo "Estado: En progreso";
        }?></p>
       <center><a href="<?= base_url('user/eliminarRutaCurso/').$curso->idCurso?>" class="btn btn-danger">Eliminar de mi ruta de cursos</a></center>
      </div>
    </div>
  </div>
<?php
}
?>

</div>

  
 



