
<div class="container">
<?php 
foreach ($cargos->result() as $value) {?>
	
  <br><div class="row">
  <div class="col-md-12">
  <div class="card">
  <div class="card-header">
    <center><h5><?=$value->cargo?></h5></center>
  </div>
  <div class="card-body">
    <h5 class="card-title">Descripción</h5>
    <p class="card-text"><?=$value->descripcion?></p>
    <center><a href="<?= base_url('user/eliminarCargoDeseos/').$value->idCargo?>" class="btn btn-danger">Eliminar de mi lista de deseos</a></center>
  </div>
  </div>
  </div>
</div><br>

<?php
}

?>


</div>