

<div class="accordion" id="accordionExample">

<?php 

foreach ($empresas->result() as $empresa) {?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $empresa->idEmpresa;?>" aria-expanded="true" aria-controls="collapseOne">
          <h5><?=$empresa->nombre;?></h5>
        </button>
      </h5>
    </div>

    <div id="collapse<?= $empresa->idEmpresa;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
        <div class="col-md-auto"> 
        <img src="<?= base_url().$empresa->url?>" class="img-thumbnail" >
        
        </div>
        <div class="col-md-4 text-center">
            
            <p><h6><?=$empresa->descripcion;?></h6></p>
            <p>Categoría: <?= $empresa->categoria;?></p>
            <p>Ciudad: <?=$empresa->ciudad;?></p>
            <p>Número de cargos:  
          <?php
          foreach ($noCargos->result() as $num) {
            if ($empresa->idEmpresa == $num->id) {
              echo $num->cantidad;
            }
          }
          ?>
        </p>
        <a href="<?= base_url('user/cargosEmpresa/').$empresa->idEmpresa?>" class="btn btn-primary">Ver más info</a>
          
        </div>
       
      
        </div>
      </div>
    </div>
  </div>
<?php
}

?>



</div>